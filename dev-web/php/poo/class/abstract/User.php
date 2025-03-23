<?php

namespace Abstact;

abstract class User
{
    public static array  $productList = [];
    public static array  $userList = [];
    public int $id;

    abstract public function product(): array;

    protected function newUser()
    {
        $userId = count(self::$userList) + 1;
        $this->id =  $userId;
        array_push(self::$userList, $userId);
    }
}
