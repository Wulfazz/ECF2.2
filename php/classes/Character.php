<?php

abstract class Character {
    protected $name;
    protected $health;
    protected $attack;
    protected $defense;
    protected $specialCooldown = 0;
    protected $specialCooldownMax;

    public function __construct($name, $health, $attack, $defense) {
        $this->name = $name;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
    }

    abstract public function basicAttack(Character $target);
    abstract public function specialAttack(Character $target);

    public function receiveDamage($damage) {
        $this->health -= max(0, $damage - $this->defense);
    }

    public function reduceCooldown() {
        if ($this->specialCooldown > 0) {
            $this->specialCooldown--;
        }
    }

    public function canPerformSpecialAttack() {
        return $this->specialCooldown === 0;
    }

    // Getters and setters
    public function getHealth() {
        return $this->health;
    }

    public function getName() {
        return $this->name;
    }
}


?>