<?php

class Player {
    private $name;
    private $characters = [];
    private $currentCharacterIndex = 0;

    public function __construct($name) {
        $this->name = $name;
    }

    // choisir le perso
    public function chooseCharacter($index) {
        if (isset($this->characters[$index])) {
            $this->currentCharacterIndex = $index;
        }
    }

    // permet de récupérer les informations du perso et de les lier au joueur
    public function getCurrentCharacter() {
        if (isset($this->characters[$this->currentCharacterIndex])) {
            return $this->characters[$this->currentCharacterIndex];
        }
        return null; 
    }

    // Permet d'infliger des changements
    public function setCharacter(Character $character) {
        $this->characters[0] = $character;
        $this->currentCharacterIndex = 0;
    }

    // Permet de réinitialiser le perso à la fin de partie
    public function resetCharacters() {
        $this->currentCharacterIndex = 0;
    }

    public function getName() {
        return $this->name;
    }
}

class Game {
    private $player1;
    private $player2;
    //On commence au tour 1
    private $currentTurn = 1;

    public function __construct(Player $player1, Player $player2) {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    //Déroulement d'un tour
    public function playTurn($attackType) {
        $activePlayer = $this->currentTurn % 2 === 0 ? $this->player2 : $this->player1;
        $waitingPlayer = $this->currentTurn % 2 === 0 ? $this->player1 : $this->player2;

        $activeCharacter = $activePlayer->getCurrentCharacter();
        $waitingCharacter = $waitingPlayer->getCurrentCharacter();

        //Gérer les attaques
        if ($attackType === 'Attaque basique') {
            $activeCharacter->basicAttack($waitingCharacter);
        } elseif ($attackType === 'Attaque spéciale' && $activeCharacter->canPerformSpecialAttack()) {
            $activeCharacter->specialAttack($waitingCharacter);
        }

        //Réduit les cooldowns pour les comps spés
        $activeCharacter->reduceCooldown();

        $this->currentTurn++;
    }

    //Vérification du Game Over
    public function checkGameOver() {
        $player1Character = $this->player1->getCurrentCharacter();
        $player2Character = $this->player2->getCurrentCharacter();
        
        // Si l'un des deux joueurs est à 0, l'autre joueur gagne. 
        if ($player1Character && $player2Character) {
            if ($player1Character->getHealth() <= 0) {
                return $this->player2;
            } elseif ($player2Character->getHealth() <= 0) {
                return $this->player1;
            }
        }

        // La partie continue
        return false; 
    }

    // On recommence la partie
    public function reset() {
        $this->player1->resetCharacters();
        $this->player2->resetCharacters();
        $this->currentTurn = 1;
    }

    public function getPlayer1() {
        return $this->player1;
    }

    public function getPlayer2() {
        return $this->player2;
    }

}

?>