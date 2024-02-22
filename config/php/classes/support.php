<?php
class Support extends Personnage
{
    public $sangsue;
    
    public function __construct($hp, $def, $atk, $sangsue)
    {
        parent::__construct($hp, $def, $atk);
        $this->sangsue = $sangsue;
    }
    public function atkspenom()
    {
        return "Sangsue";
    }
    public function atkspe($cible)
    {
        $cible->hp -= $this->sangsue;
        $this->hp += $this->sangsue;
    }
}
?>