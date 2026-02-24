<?php

namespace App\Pedidos\UseCases;

use App\Pedidos\Domain\Pedidos;
use App\Pedidos\PedidosRepositoryInterface;
use Exception;

class GetPedidoByIdUseCase
{
    private PedidosRepositoryInterface $repository;
    public function __construct(PedidosRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): Pedidos
    {
        $found_order = $this->repository->getById($id);
        if($found_order === null)
            {
                throw new Exception("Erro: Pedido nao encontrado", 404);
            }
        else
            {
                return $found_order;
            }
    }
}