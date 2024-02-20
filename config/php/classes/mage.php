<?php
class Mage extends Personnage
{
    public $atomique;
    
    public function __construct($hp, $def, $atk, $atomique)
    {
        parent::__construct($hp, $def, $atk);
        $this->atomique = $atomique;
    }
    public function atkspenom()
    {
        return "Atomique";
    }
    public function atkspe($cible)
    {
        $cible->hp -= $this->atomique;
    }
}
?>