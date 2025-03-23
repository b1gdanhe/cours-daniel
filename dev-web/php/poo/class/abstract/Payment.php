<?php

abstract  class Payment
{
    abstract public function pay(int $amount): bool;
    
}
