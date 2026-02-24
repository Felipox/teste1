<?php

namespace App\Pedidos;

use App\Pedidos\Domain\Pedidos;

Interface PedidosRepositoryInterface
{
    function save(Pedidos $order):void;
    function listAll():array;
    function getById(string $id):?Pedidos;
    function update(Pedidos $updated_order):void;
}