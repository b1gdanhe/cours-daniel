<?php
class_path('abstract/User.php');

class Admin extends Abstact\User
{

    public function __construct()
    {
        $this->newUser();
    }
    public function product(): array
    {
        return parent::$productList;
    }
}
