<?php

// Inclure les fichiers nécessaires
require_once 'classes/Character.php';
require_once 'classes/Mage.php';
require_once 'classes/Fighter.php';
require_once 'classes/Support.php';
require_once 'classes/Shooter.php';
require_once 'classes/Game.php';

function initializeGame(&$game, $player1Name = 'Joueur 1', $player2Name = 'Joueur 2') {
    $player1 = new Player($player1Name);
    $player2 = new Player($player2Name);
    $game = new Game($player1, $player2);
}

if (!isset($_SESSION['game'])) {
    initializeGame($game);
    $_SESSION['game'] = serialize($game);
} else {
    $game = unserialize($_SESSION['game']);
}

function createCharacterInstance($characterType) {
    switch ($characterType) {
        case 'Mage':
            return new Mage("Nom du Mage");
        case 'Fighter':
            return new Fighter("Nom du Combattant");
        case 'Support':
            return new Support("Nom du Support");
        case 'Shooter':
            return new Shooter("Nom du Tireur");
        default:
            return null; 
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
// Dans le switch case du traitement des actions de formulaire
        case 'select_character_p1':
            $characterType = $_POST['character']; // Le type de personnage choisi pour le joueur 1
            $player1 = $game->getPlayer1(); // Accéder au joueur 1
            $player1->setCharacter(createCharacterInstance($characterType)); // Associer le personnage au joueur 1
            break;
        case 'select_character_p2':
            $characterType = $_POST['character']; // Le type de personnage choisi pour le joueur 2
            $player2 = $game->getPlayer2(); // Accéder au joueur 2
            $player2->setCharacter(createCharacterInstance($characterType)); // Associer le personnage au joueur 2
            break;
            case 'attack_p1':
            case 'attack_p2':
                // Traiter l'attaque
                $game->playTurn($_POST['attack']);
                $winner = $game->checkGameOver();
                if ($winner !== false) {
                    echo "<p>Le jeu est terminé. Le gagnant est : " . $winner->getName() . "</p>";
                    // Optionnel : afficher un bouton ou un lien pour réinitialiser le jeu
                }
                break;
            case 'reset':
                // Réinitialiser le jeu
                unset($_SESSION['game']);
                header("Location: index.php");
                exit;
        }
    }
    $_SESSION['game'] = serialize($game);
}


?>
<div class="centerDiv">
    <h1>Jeu de Combat Tour par Tour</h1>
    <div id="game">
        <!-- Sélection des personnages pour le joueur 1 -->
        <form id="character-selection-p1" method="post">
            <input type="hidden" name="action" value="select_character_p1">
            <label>Choix joueur 1 :</label>
            <select name="character">
                <option value="Mage">Mage</option>
                <option value="Fighter">Combattant</option>
                <option value="Support">Support</option>
                <option value="Shooter">Tireur</option>
            </select>
            <input type="submit" value="Choisir ce personnage">
        </form>

        <!-- Sélection des personnages pour le joueur 2 -->
        <form id="character-selection-p2" method="post">
            <input type="hidden" name="action" value="select_character_p2">
            <label>Choix joueur 2 :</label>
            <select name="character">
                <option value="Mage">Mage</option>
                <option value="Fighter">Combattant</option>
                <option value="Support">Support</option>
                <option value="Shooter">Tireur</option>
            </select>
            <input type="submit" value="Choisir ce personnage">
        </form>

    <!-- Zone d'affichage du combat -->
    <div id="battlefield">
        <div class="player" id="player1">
            <h2>Joueur 1</h2>
            <?php if ($game->getPlayer1()->getCurrentCharacter()): ?>
                <?php
                $character1 = $game->getPlayer1()->getCurrentCharacter();
                echo "<p>Nom: " . $character1->getName() . "</p>";
                echo "<p>Santé: " . $character1->getHealth() . "</p>";
                // Afficher d'autres détails selon votre implémentation
                ?>
            <?php else: ?>
                <p>Aucun personnage sélectionné</p>
            <?php endif; ?>
            <!-- Boutons d'attaque pour le joueur 1 -->
            <form id="attack-form-p1" method="post">
                <input type="hidden" name="action" value="attack_p1">
                <input type="submit" name="attack" value="basic" /> Attaque Basique
                <input type="submit" name="attack" value="special" /> Attaque Spéciale
            </form>
        </div>
        <div class="player" id="player2">
            <h2>Joueur 2</h2>
            <?php if ($game->getPlayer2()->getCurrentCharacter()): ?>
                <?php
                $character2 = $game->getPlayer2()->getCurrentCharacter();
                echo "<p>Nom: " . $character2->getName() . "</p>";
                echo "<p>Santé: " . $character2->getHealth() . "</p>";
                // Afficher d'autres détails selon votre implémentation
                ?>
            <?php else: ?>
                <p>Aucun personnage sélectionné</p>
            <?php endif; ?>
            <!-- Boutons d'attaque pour le joueur 2 -->
            <form id="attack-form-p2" method="post">
                <input type="hidden" name="action" value="attack_p2">
                <input type="submit" name="attack" value="basic" /> Attaque Basique
                <input type="submit" name="attack" value="special" /> Attaque Spéciale
            </form>
        </div>
    </div>

        <!-- Bouton pour recommencer -->
        <form id="reset-form" method="post">
            <input type="hidden" name="action" value="reset">
            <input type="submit" value="Recommencer">
        </form>
    </div>
</div>