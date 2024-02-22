<?php

// Inclure les fichiers nécessaires
require_once 'classes/Character.php';
require_once 'classes/Mage.php';
require_once 'classes/Fighter.php';
require_once 'classes/Support.php';
require_once 'classes/Shooter.php';
require_once 'classes/Game.php';

//initialisation des joueurs
function initializeGame(&$game, $player1Name = 'Joueur 1', $player2Name = 'Joueur 2') {
    $player1 = new Player($player1Name);
    $player2 = new Player($player2Name);
    $game = new Game($player1, $player2);
}

//initialisation de la game
if (!isset($_SESSION['game'])) {
    initializeGame($game);
    $_SESSION['game'] = serialize($game);
} else {
    $game = unserialize($_SESSION['game']);
}

//Les persos
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

// Pour disable les boutons quand pas son tour
if (!isset($_SESSION['currentTurn'])) {
    $_SESSION['currentTurn'] = 1; 
}

//déroulement de la partie
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
        
        case 'select_character_p1':
            $characterType = $_POST['character']; // Le type de personnage choisi pour le joueur 1
            $player1 = $game->getPlayer1(); // joueur 1
            $player1->setCharacter(createCharacterInstance($characterType)); 
            break;

        case 'select_character_p2':
            $characterType = $_POST['character']; // Le type de personnage choisi pour le joueur 2
            $player2 = $game->getPlayer2(); // joueur 2
            $player2->setCharacter(createCharacterInstance($characterType)); 
            break;

            case 'attack_p1':
            case 'attack_p2':

                //Attaque
                $game->playTurn($_POST['attack']);
                $winner = $game->checkGameOver();
                //Fin de game, on a un vainqueur si conditions de GameOver remplies! 
                if ($winner !== false) {
                    echo "<div class='centerDiv'><p>Le jeu est terminé. Le gagnant est : " . $winner->getName() . "</div></p>";
                }
                //Pour toujours connaître à qui le tour
                $_SESSION['currentTurn'] = $_SESSION['currentTurn'] == 1 ? 2 : 1;
                break;

            //Recommencer une partie
            case 'reset':
                unset($_SESSION['game']);
                //on reset en mettant le joueur 1 en premier joueur
                $_SESSION['currentTurn'] = 1;
                header("Location: index.php");
                exit;
        }
    }

    //Sauvegarde de la game
    $_SESSION['game'] = serialize($game);
}

?>
