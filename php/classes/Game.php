<?php

class Player {
    private $name;
    private $characters = [];
    private $currentCharacterIndex = 0;

    public function __construct($name) {
        $this->name = $name;
    }

    public function addCharacter(Character $character) {
        $this->characters[] = $character;
    }

    public function chooseCharacter($index) {
        if (isset($this->characters[$index])) {
            $this->currentCharacterIndex = $index;
        }
    }

    public function getCurrentCharacter() {
        if (isset($this->characters[$this->currentCharacterIndex])) {
            return $this->characters[$this->currentCharacterIndex];
        }
        return null; 
    }

    public function setCharacter(Character $character) {
        $this->characters[0] = $character;
        $this->currentCharacterIndex = 0;
    }

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
    private $currentTurn = 1;

    public function __construct(Player $player1, Player $player2) {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function playTurn($attackType) {
        $activePlayer = $this->currentTurn % 2 === 0 ? $this->player2 : $this->player1;
        $waitingPlayer = $this->currentTurn % 2 === 0 ? $this->player1 : $this->player2;

        $activeCharacter = $activePlayer->getCurrentCharacter();
        $waitingCharacter = $waitingPlayer->getCurrentCharacter();

        if ($attackType === 'basic') {
            $activeCharacter->basicAttack($waitingCharacter);
        } elseif ($attackType === 'special' && $activeCharacter->canPerformSpecialAttack()) {
            $activeCharacter->specialAttack($waitingCharacter);
        }

        $activeCharacter->reduceCooldown();

        $this->currentTurn++;
    }

    public function checkGameOver() {
        if ($this->player1->getCurrentCharacter()->getHealth() <= 0) {
            return $this->player2; // Le joueur 2 gagne
        } elseif ($this->player2->getCurrentCharacter()->getHealth() <= 0) {
            return $this->player1; // Le joueur 1 gagne
        }
        return false; // Le jeu continue
    }

    public function reset() {
        $this->player1->resetCharacters();
        $this->player2->resetCharacters();
        $this->currentTurn = 1;
    }

    // Méthode pour obtenir le joueur 1
    public function getPlayer1() {
        return $this->player1;
    }

    // Méthode pour obtenir le joueur 2
    public function getPlayer2() {
        return $this->player2;
    }

}

?>