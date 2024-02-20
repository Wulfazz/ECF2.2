<?php

// Initialisation des joueurs
$joueur1 = isset($_SESSION['joueur1']) ? $_SESSION['joueur1'] : null;
$joueur2 = isset($_SESSION['joueur2']) ? $_SESSION['joueur2'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['choixChampions'])) {
        // Réception des choix des joueurs
        $joueur1_perso = $_POST['choixJoueur1'];
        $joueur2_perso = $_POST['choixJoueur2'];

        // Création des objets personnages
        $joueur1 = createCharacter($joueur1_perso, [300, 50, 30, 20]); // Exemple de paramètres
        $joueur2 = createCharacter($joueur2_perso, [250, 40, 80, 30]); // Adaptez les paramètres selon le personnage

        // Sauvegarde des états dans la session
        $_SESSION['joueur1'] = $joueur1;
        $_SESSION['joueur2'] = $joueur2;
    }

    // Logique d'attaque
    attackLogic($joueur1, $joueur2);
}

// Fonction de création de personnage
function createCharacter($type, $params) {
    switch ($type) {
        case 'Combattant':
            return new Combattant(...$params);
        case 'Mage':
            return new Mage(...$params);
        case 'Support':
            return new Support(...$params);
        case 'Tireur':
            return new Tireur(...$params);
        default:
            return null;
    }
}

// Gestion des attaques
function attackLogic(&$joueur1, &$joueur2) {
    if (isset($_POST['attaque_joueur1'])) {
        // Joueur 1 attaque Joueur 2
        $joueur1->dgts($joueur2);
        checkGameOver($joueur2, "Joueur 1 a gagné!");
    }

    if (isset($_POST['attaque_joueur2'])) {
        // Joueur 2 attaque Joueur 1
        $joueur2->dgts($joueur1);
        checkGameOver($joueur1, "Joueur 2 a gagné!");
    }

    // Attaques spéciales...
}

// Vérification de la fin de jeu
function checkGameOver($joueur, $message) {
    if (!$joueur->vivant()) {
        echo $message;
        session_destroy(); // Optionnel: Réinitialiser le jeu
    }
}

?>

<!-- Formulaire de sélection des personnages -->
<form method="POST">
    <select name="choixJoueur1">
        <option value="Combattant">Combattant</option>
        <option value="Mage">Mage</option>
        <option value="Support">Support</option>
        <option value="Tireur">Tireur</option>
    </select>

    <select name="choixJoueur2">
        <option value="Combattant">Combattant</option>
        <option value="Mage">Mage</option>
        <option value="Support">Support</option>
        <option value="Tireur">Tireur</option>
    </select>
    <input type="submit" name="choixChampions" value="Choisir son champion">
</form>

<!-- Affichage des boutons d'attaque -->
<div>
    <form method="post">
        <button type="submit" name="attaque_joueur1">Attaquer Joueur 2</button>
        <!-- Ajoutez votre logique pour désactiver le bouton si nécessaire -->
    </form>

    <form method="post">
        <button type="submit" name="attaque_joueur2">Attaquer Joueur 1</button>
        <!-- Ajoutez votre logique pour désactiver le bouton si nécessaire -->
    </form>
</div>
