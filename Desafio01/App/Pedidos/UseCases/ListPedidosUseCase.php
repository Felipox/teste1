<?php

namespace App\Pedidos\UseCases;

use App\Pedidos\PedidosRepositoryInterface;
class ListPedidosUseCase
{
    private PedidosRepositoryInterface $repository;

    function __construct(PedidosRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function execute(): array
    {
        $list = $this->repository->listAll();

        return $list;
    }
}