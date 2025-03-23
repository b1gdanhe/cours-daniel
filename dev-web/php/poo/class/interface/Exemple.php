<?php

interface  A
{
    function gretting(): string;
    function sum(int $a, int $b): int;
}

interface  AA
{
    public const VALUE  = 3;
    function multi(int $a): int;
}

class B implements A, AA
{
    public function gretting(): string
    {
        return 'Bonjour';
    }

    public function sum(int $a, int $b): int
    {
        return $a  + $b;
    }

    public function multi(int $a): int
    {
        return $a  * AA::VALUE;
    }
}
