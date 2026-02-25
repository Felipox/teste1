<?php

namespace App\Movimentacao\Domain;


class Movimentacao
{
    private string $id;
    private string $product_id;
    private ?string $order_id;
    private string $type;
    private int $quantity;
    private string $date_time;
    private string $reason;

    public function __construct( string $product_id, string $type, int $quantity, string $reason, string $date_time="",string $id="", ?string $order_id=null)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->order_id = $order_id;
        $this->type = $type;
        $this->quantity = $quantity;
        $this->reason = $reason;
        $this->date_time = $date_time !== "" ? $date_time : date("Y-m-d H:i:s");
    }

    public function setId(string $id):void
    {
        $this->id = $id;
    }

    public function getId():string
    {
        return $this->id;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getDateTime(): string
    {
        return $this->date_time;
    }
}