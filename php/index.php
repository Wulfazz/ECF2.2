<?php
session_start();

require_once 'tools/selection.php';
require_once 'classes/Character.php';
require_once 'classes/Mage.php';
require_once 'classes/Fighter.php';
require_once 'classes/Support.php';
require_once 'classes/Shooter.php';
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