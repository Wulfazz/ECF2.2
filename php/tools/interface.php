<!-- Partie interface -->
<div class="centerDiv">
    <h1>NOOB</h1>
    <div id="game">

    <!-- Sélection des personnages pour le joueur 1, le if pour conditionner la sélection -->
    <?php if (!$game->getPlayer1()->getCurrentCharacter()): ?>
        <form id="character-selection-p1" method="post">
            <input type="hidden" name="action" value="select_character_p1">
            <label>Choix joueur 1 :</label>
            <select name="character">
                <!-- C'est mieux de mettre un choix bateau en premier -->
                <option value="Mage">Mage - Gaïa</option>
                <option value="Fighter">Combattant - Arthenon</option>
                <option value="Support">Support - Sparadrap</option>
                <option value="Shooter">Tireur - Ivy</option>
            </select>
            <input type="submit" value="Choisir ce personnage">
        </form>
    <?php else: ?>
        <!-- Message au lieu du sélecteur si un perso est sélectionné -->
        <p>Joueur 1 a déjà choisi son personnage.</p>
    <?php endif; ?>

    <!-- Sélection des personnages pour le joueur 2 -->
    <?php if (!$game->getPlayer2()->getCurrentCharacter()): ?>
        <form id="character-selection-p2" method="post">
            <input type="hidden" name="action" value="select_character_p2">
            <label>Choix joueur 2 :</label>
            <select name="character">
                <!-- C'est mieux de mettre un choix bateau en premier -->
                <option value="Mage">Mage - Gaïa</option>
                <option value="Fighter">Combattant - Arthenon</option>
                <option value="Support">Support - Sparadrap</option>
                <option value="Shooter">Tireur - Ivy</option>
            </select>
            <input type="submit" value="Choisir ce personnage">
        </form>
    <?php else: ?>
        <!-- Message au lieu du sélecteur si un perso est sélectionné -->
        <p>Joueur 2 a déjà choisi son personnage.</p>
    <?php endif; ?>

    <!-- On vérifie si on est en GameOver ou pas -->
    <?php $gameOver = $game->checkGameOver(); ?>
    <!-- Bienvenue ! Sur le champ de bataille !!!!!! -->
    <div id="battlefield">
        <div class="player" id="player1">
            <!-- Celui qui commence -->
            <h2>Joueur 1</h2>

            <?php if ($game->getPlayer1()->getCurrentCharacter()): ?>
                <?php
                //informations perso choisi
                $character1 = $game->getPlayer1()->getCurrentCharacter();
                echo "<p>Nom : " . $character1->getName() . "</p>";
                echo "<p>Santé : " . $character1->getHealth() . "</p>";
                echo "<p>Défense : " . $character1->getDef() . "</p>";
                echo "<p>Attaque : " . $character1->getAtk() . "</p>";
                //Le cooldown pour savoir combien de tour il reste avant de relancer une attaque
                echo "<p>" . $character1->getSpeName() . " : " . $character1->getSpe() . " / cooldown ( " . $character1->getSpecialCooldown() . " ) " . "</p>";
                ?>
            <?php else: ?>
                <p>Aucun champion sélectionné</p>
            <?php endif; ?>

            <!-- Boutons d'attaque pour le joueur 1 -->
            <?php if (!$gameOver): ?>
                <form id="attack-form-p1" method="post">
                    <input type="hidden" name="action" value="attack_p1">
                    <input type="submit" name="attack" value="Attaque basique" <?= $_SESSION['currentTurn'] != 1 ? 'disabled' : ''; ?> /> 
                    <input type="submit" name="attack" value="Attaque spéciale" <?= $_SESSION['currentTurn'] != 1 ? 'disabled' : ''; ?> />
                </form>
            <?php endif; ?>
        </div>
        <div class="player" id="player2">
            <h2>Joueur 2</h2>

            <?php if ($game->getPlayer2()->getCurrentCharacter()): ?>
                <?php
                //informations perso choisi
                $character2 = $game->getPlayer2()->getCurrentCharacter();
                echo "<p>Nom : " . $character2->getName() . "</p>";
                echo "<p>Santé : " . $character2->getHealth() . "</p>";
                echo "<p>Défense : " . $character2->getDef() . "</p>";
                echo "<p>Attaque : " . $character2->getAtk() . "</p>";
                //Le cooldown pour savoir combien de tour il reste avant de relancer une attaque
                echo "<p>" . $character2->getSpeName() . " : " . $character2->getSpe() . " / cooldown ( " . $character2->getSpecialCooldown() . " ) " . "</p>";
                ?>
            <?php else: ?>
                <p>Aucun champion sélectionné</p>
            <?php endif; ?>

            <!-- Boutons d'attaque pour le joueur 2 -->
            <?php if (!$gameOver): ?>
                <form id="attack-form-p1" method="post">
                    <input type="hidden" name="action" value="attack_p2">
                    <input type="submit" name="attack" value="Attaque basique" <?= $_SESSION['currentTurn'] != 2 ? 'disabled' : ''; ?> />
                    <input type="submit" name="attack" value="Attaque spéciale" <?= $_SESSION['currentTurn'] != 2 ? 'disabled' : ''; ?> />
                </form>
            <?php endif; ?>            
        </div>
    </div>

        <!-- Bouton pour recommencer -->
        <form id="reset-form" method="post">
            <input type="hidden" name="action" value="reset">
            <input type="submit" value="Recommencer">
        </form>
    </div>
</div>