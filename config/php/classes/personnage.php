<?php

    class Personnage
    {

       //Attributs 
       public $hp;
       public $atk;
       public $def;

       public function __construct($hp, $atk, $def) {
        $this->hp = $hp;
        $this->atk = $atk;
        $this->def = $def;
       } 

       //Getters
       public function getHp(){
        return $this->hp;
       }

       public function getAtk(){
        return $this->atk;
       }

       public function getDef(){
        return $this->def;
       }

       //Setters
       public function setHp($hp){
        return $this->hp = $hp;
       }

       public function setAtk($atk){
        return $this->atk = $atk;
       }

       public function setDef($def){
        return $this->def = $def;
       }

       //Methods
       public function dgts($cible){
        $damage = max(0, $this->atk - $cible->def);
        $cible->hp -= $damage;
    }

       public function vivant(){
        return $this->hp > 0;
       }

       public function conc(){
        return "Vie : " . $this->hp . "<br>" . "Défense : " . $this->def . "<br>" . "Attaque : " . $this->atk . "";
       }

    }
?>