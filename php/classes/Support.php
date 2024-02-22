<?php

class Support extends Character {
    public function __construct($name) {
        parent::__construct($name, 80, 5, "Mercurochrome","+20", 8);
        $this->specialCooldownMax = 4;
    }

    public function basicAttack(Character $target) {
        $target->receiveDamage($this->attack);
    }

    public function specialAttack(Character $target) {
        if ($this->canPerformSpecialAttack()) {
            // Exemple: soigne un allié ou inflige des dégâts réduits à l'ennemi
            $this->health += 20; // Auto-soin pour simplifier
            $this->specialCooldown = $this->specialCooldownMax;
        }
    }
}

?>