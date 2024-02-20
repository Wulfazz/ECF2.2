<?php
class Tireur extends Personnage
{
    public $liberte;
    
    public function __construct($hp, $def, $atk, $liberte)
    {
        parent::__construct($hp, $def, $atk);
        $this->liberte = $liberte;
    }
    public function atkspenom()
    {
        return "Liberté";
    }
    public function atkspe($cible)
    {
        $cible->hp -= $this->liberte;
    }
}
?>