<?php
class Account
{
    private string $nom;
    private  string $prenom;
    private int $solde = 0;
    public  static int $plafond = -3000;
    public static array $userHistories = [];
    public static float $totalAmount = 0;

    public function __construct(string  $nom, string $prenom, string $solde)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->solde = $solde;
        self::$userHistories[] = [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'solde' => $this->solde,
        ];
        self::$totalAmount += $this->solde;
    }

    public function setSolde(int $newSolde): void
    {
        $this->solde =  $newSolde;
    }


    public function retrait(int $montant): void
    {
        if (($this->solde - $montant) >= self::$plafond) {
            $this->solde -= $montant;
            self::$totalAmount -= $montant;
        } else {
            dd('Solde inssuffisant');
        }
    }

    public function depot(int $montant): void
    {
        if ($montant > 0) {
            $this->solde += $montant;
            self::$totalAmount += $montant;
        } else {
            dd('Veullez fournir un montant valide');
        }
    }

    public function solde(): int
    {
        return $this->solde;
    }

    public function info(): array
    {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'solde' => $this->solde,
        ];
    }
    public function  getHistory(): array
    {
        return self::$userHistories;
    }
}
