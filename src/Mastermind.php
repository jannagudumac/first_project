<?php

namespace App;

class Mastermind
{
    private int $taille;
    private array $codeSecret;
    private array $essais = [];

    public function __construct(int $taille = 4)
    {
        $this->taille = $taille; //size of secret word
        $digits = range(0, 9); // range of possible numbers
        shuffle($digits); // mix them
        $this->codeSecret = array_slice($digits, 0, $taille);
        // takes the first 4 digits of the list
    }

    public function test($code)
    {
    $bienPlaces = 0;
    $malPlaces = 0;

    for ($i = 0; $i < $this->taille; $i++) {
        //even if code comes as string in php we can still $code[0] 
        if ($code[$i] == $this->codeSecret[$i]) {
            $bienPlaces++;
        }
        elseif (in_array($code[$i], $this->codeSecret)) {
            $malPlaces++;
        }
    }

    $this->essais[] = [
        'code' => $code,
        'bien' => $bienPlaces,
        'mal' => $malPlaces
    ];

    return [
        'bien' => $bienPlaces,
        'mal' => $malPlaces
    ];
    }

    public function getEssais(): array
    {
        return $this->essais;
    }

    public function getTaille(): int
    {
        return $this->taille;
    }

    public function isFini(): bool
    {
        return false;
    }
}