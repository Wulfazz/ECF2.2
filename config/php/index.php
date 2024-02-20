<?php
session_start();

// Inclusions des classes nécessaires
include 'tools/selection.php';
include_once 'classes/personnage.php';
include_once 'classes/combattant.php';
include_once 'classes/mage.php';
include_once 'classes/support.php';
include_once 'classes/tireur.php';

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