<?php

namespace App\Pedidos\Domain;

class Pedidos
{
    private string $id;
    private string $date_time;
    private array $products_orders;

    public function __construct(string $id="", string $date_time="", array $products_orders)
    {
        $this->id = $id;
        $this->date_time = $date_time !== "" ? $date_time : date("Y-m-d H:i:s");
        $this->products_orders = $products_orders;
    }

    public function setId(string $id):void
    {
        $this->id = $id;
    }

    public function getId():string
    {
        return $this->id;
    }

    public function getDateTime():string
    {
        return $this->date_time;
    }

    public function getProductsOrders():array
    {
        return $this->products_orders;
    }

    public function getValorTotal():int
    {
        $total = 0;
        foreach($this->products_orders as $product_order)
        {
            $total += $product_order->getPrice() * $product_order->getQuantity();
        }
        return $total;
    }
}