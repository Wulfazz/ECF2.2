<?php
session_start();

// Gérer la bataille
require_once 'tools/battle.php';
//Gérer l'interface de jeu
require_once 'tools/interface.php';

// Classe parent
require_once 'classes/Character.php';
// Classes enfants 
require_once 'classes/Mage.php';
require_once 'classes/Fighter.php';
require_once 'classes/Support.php';
require_once 'classes/Shooter.php';

// Gérer la game
require_once 'classes/Game.php';

?>
    
    <!-- connexion à la bdd -->
    <?php
    require_once 'db.php';
    ?>

    <?php
    include  'header.php';
    ?>

    <!-- footer -->
    <?php
    include  'footer.php';
    ?>