<?php
class  EtreVivant
{
    protected $isLiving = true;
    protected $name;

    public function respirer(string $gaz)
    {
        $this->isLiving = $gaz === 'O2';
    }

    public function getNom()
    {
        return $this->name;
    }

    public function setNom(string $name)
    {
        $this->name = $name;
    }
}

class Humain extends EtreVivant
{
    protected $sex;
    protected $country;

    public function travel(string $from, string $to)
    {
        echo "Je voyage sur $to depuis $from";
    }
}


