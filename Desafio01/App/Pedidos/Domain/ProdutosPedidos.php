<?php

namespace App\Pedidos\Domain;

class ProdutosPedidos
{
    private string $order_id;
    private string $product_id;
    private int $quantity;
    private int $unit_price;

    public function __construct(string $product_id, int $quantity, int $unit_price,string $order_id="")
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;
    }

    public function getOrderId():string
    {
        return $this->order_id;
    }

    public function getProductId():string
    {
        return $this->product_id;
    }

    public function getQuantity():int
    {
        return $this->quantity;
    }

    public function getUnitPrice():int
    {
        return $this->unit_price;
    }
}

