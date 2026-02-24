<?php

namespace App\Produto\Domain;

class Produto
{
    private string $product_id;
    private string $product_name;
    private int $product_price;
    private string $category_id;
    private int $product_quantity;

    function __construct(string $product_name, int $product_price, string $category_id, int $product_quantity, string $id="")
    {
        $this->product_id = $id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->category_id = $category_id;
        $this->product_quantity = $product_quantity;
    }

    public function setId(string $id):void
    {
        $this->product_id = $id;
    }
    
    public function setName(string $new_name):void
    {
        $this->product_name = $new_name;
    }

    public function setPrice(int $new_price):void
    {
        $this->product_price = $new_price;
    }

    public function setCategory(string $category):void
    {
        $this->category_id = $category;
    }

    public function setQuantity(int $quantity):void
    {
        $this->product_quantity = $quantity;
    }


    

    public function getId():string
    {
        return $this->product_id;
    }
    public function getName():string
    {
        return $this->product_name;
    }

    public function getPrice():int
    {
        return $this->product_price;
    }

    public function getCategoryId():string
    {
        return $this->category_id;
    }

    public function getQuantity():int
    {
        return $this->product_quantity;
    }

}