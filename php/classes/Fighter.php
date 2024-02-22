<?php

class Fighter extends Character {
    public function __construct($name) {
        parent::__construct($name, 120, 10, 10);
        $this->specialCooldownMax = 2;
    }

    public function basicAttack(Character $target) {
        $target->receiveDamage($this->attack);
    }

    public function specialAttack(Character $target) {
        if ($this->canPerformSpecialAttack()) {
            $target->receiveDamage($this->attack * 1.5);
            $this->specialCooldown = $this->specialCooldownMax;
        }
    }
}

?>