<?php

abstract class Character {
    // Nom
    protected $name;
    // Vie
    protected $health;
    // Attaque basique
    protected $attack;
    // Défense
    protected $defense;
    // Nom comp spé
    protected $specname;
    // Détail comp spé
    protected $attackspe;
    // Cooldown actuel
    protected $specialCooldown = 0;
    // Cooldown décompte
    protected $specialCooldownMax;

    // construct parent
    public function __construct($name, $health, $attack, $specname, $attackspe, $defense) {
        $this->name = $name;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->specname = $specname;
        $this->attackspe = $attackspe;
    }

    // ciblage
    abstract public function basicAttack(Character $target);
    abstract public function specialAttack(Character $target);

    // Quand le perso reçoit des dégats
    public function receiveDamage($damage) {
        $this->health -= max(0, $damage - $this->defense);
    }

    // Réduction du cooldown pour spé
    public function reduceCooldown() {
        if ($this->specialCooldown > 0) {
            $this->specialCooldown--;
        }
    }

    // Quand le CD est à 0, on peut utilisé comp spé
    public function canPerformSpecialAttack() {
        return $this->specialCooldown === 0;
    }

    //récupération de la vie
    public function getHealth() {
        return $this->health;
    }

    //récupération du nom 
    public function getName() {
        return $this->name;
    }

    //récupération de la défense
    public function getDef(){
        return $this->defense;
    }

    //récupération de l'attaque
    public function getAtk(){
        return $this->attack;
    }

    //récupération de l'attaque spé
    public function getSpe(){
        return $this->attackspe;
    }

    //récupération nom de comp spé
    public function getSpeName(){
        return $this->specname;
    }

    //récupération du cooldown en cours
    public function getSpecialCooldown(){
        return $this->specialCooldown;
    }

}


?>