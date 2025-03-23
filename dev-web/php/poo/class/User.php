<?php

class User
{
    public static int $ban = 0;

    public function banUser(): void
    {
        self::$ban += 1;
    }
    public function getBanUser(): int
    {
        return  self::$ban;
    }
}
