<?php

class Seller  extends  Abstact\User
{
    public function __construct()
    {
        $this->newUser();
    }

    public function product(): array
    {
        $listProd = [];
        foreach (self::$productList as $key => $product) {
            if ($product['sellerId'] == $this->id) {
                array_push($listProd, $product);
            }
        }
        return $listProd;
    }

    public function addProduct(string $name): void
    {
        if (isset($name) && strlen($name) > 0) {
            array_push(parent::$productList, [
                'name' => $name,
                'sellerId' => $this->id,
            ]);
        }
    }


    public function updateProduct(string $oldName, $newName): void
    {
        parent::$productList =  array_map(function ($product) use ($oldName, $newName) {
            if ($product['name'] == $oldName && $product['sellerId'] == $this->id) {
                $product['name'] =  $newName;
            }
            return $product;
        }, parent::$productList);
    }

    public function deleteProduct(string $name): void
    {
        foreach (parent::$productList as $key => $product) {
            if ($product['name'] == $name && $product['sellerId'] == $this->id) {
                unset(parent::$productList[$key]);
            }
        }
    }
    public function deleteProduct2(string $name): void
    {
        $product = null;
        $product =  array_find(parent::$productList, function ($product, $key) use ($name) {
            return $product['name'] == $name && $product['sellerId'] == $this->id;
        });
        if ($product !== null) {
            unset(parent::$productList[array_search($product, parent::$productList)]);
        }
    }
}
