<?php

namespace App\Pedidos\Domain\Infrastructure;

use App\Pedidos\PedidosRepositoryInterface;
use App\Pedidos\Domain\Pedidos;

class MemoryPedidosRepository implements PedidosRepositoryInterface
{
    public function __construct()
    {
        if(!isset($_SESSION['orders']))
            {
                $_SESSION['orders'] = [];
            }
    }

    public function save(Pedidos $order):void
    {
        $new_id = uniqid();
        $order->setId($new_id);
        $_SESSION['orders'][$new_id] = $order;
    }

    public function listAll():array
    {
        return $_SESSION['orders'];
    }

    public function getById(string $wanted_id):?Pedidos
    {
        foreach($_SESSION['orders'] as $order)
            {
                if($order->getId() === $wanted_id)
                    {
                        return $order;
                    }
            }
            return null;
    }

    public function update(Pedidos $updated_order):void
    {
        foreach($_SESSION['orders'] as $index => $order)
            {
                if($order->getId() === $updated_order->getId())
                    {
                        $_SESSION['orders'][$index] = $updated_order;
                    }
            }
    }

    public function delete(string $delete_id):void
    {
        foreach($_SESSION['orders'] as $index => $order)
            {
                if($order->getId()=== $delete_id)
                    {
                        unset($_SESSION['orders'][$index]);
                        $_SESSION['orders'] = array_values($_SESSION['orders']);
                        break;    
                    }
            }
    }
}