<?php

class Mage extends Character {
    public function __construct($name) {
        parent::__construct($name, 100, 15, "Armagédon", 30, 5);
        $this->specialCooldownMax = 3;
    }

    public function basicAttack(Character $target) {
        $target->receiveDamage($this->attack);
    }

    public function specialAttack(Character $target) {
        if ($this->canPerformSpecialAttack()) {
            $target->receiveDamage($this->attack * 2);
            $this->specialCooldown = $this->specialCooldownMax;
        }
    }
}


?>