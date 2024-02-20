<?php
class Combattant extends Personnage
{
    public $charge;
    
    public function __construct($hp, $def, $atk, $charge)
    {
        parent::__construct($hp, $def, $atk);
        $this->charge = $charge;
    }
    public function atkspenom()
    {
        return "Charge";
    }
    public function atkspe($cible)
    {
        $cible->hp -= $this->charge;
    }
}
?>