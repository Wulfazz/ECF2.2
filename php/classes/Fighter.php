<?php

class Fighter extends Character {
    // Ajout des infos en fonction construct parent
    public function __construct($name) {
        parent::__construct($name, 120, 10, "Excalibur", 15, 10);
        $this->specialCooldownMax = 2;
    }

    // Ciblage de l'attaque
    public function basicAttack(Character $target) {
        $target->receiveDamage($this->attack);
    }

    // Détails de la compétence spé
    public function specialAttack(Character $target) {
        if ($this->canPerformSpecialAttack()) {
            $target->receiveDamage($this->attack * 1.5);
            $this->specialCooldown = $this->specialCooldownMax;
        }
    }
}

?>