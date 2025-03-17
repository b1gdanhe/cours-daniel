<?php
class Account
{
    private string $nom;
    private  string $prenom;
    private string $email;
    private string $password;
    private int $solde = 0;
    public  $plafond = -3000;

    public function __construct(string  $nom, string $prenom, string $email)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    public function getSolde()
    {
        return $this->solde;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setSolde(int $newSolde): void
    {
        $this->solde =  $newSolde;
    }

    public function retrait(int $montant): void
    {
        if (($this->solde - $montant) >= $this->plafond) {
            $this->solde -= $montant;
        } else {
            dd('Solde inssuffisant');
        }
    }

    public function depot(int $montant): void
    {
        $this->solde += $montant;
    }
}
