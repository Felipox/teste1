<?php

namespace App\Produto\UseCases;

use App\Pedidos\PedidosRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use Exception;

class DeleteProdutoUseCase
{
    private ProdutoRepositoryInterface $product_repository;
    private PedidosRepositoryInterface $order_repository;

    public function __construct(ProdutoRepositoryInterface $product_repository, PedidosRepositoryInterface $order_repository)
    {
        $this->product_repository = $product_repository;
        $this->order_repository = $order_repository;
    }

    public function execute(string $id):void
    {
        $product = $this->product_repository->getById($id);

        if ($product === null) {
            throw new Exception("Erro: Produto nao encontrado", 404);
        }

        $all_orders = $this->order_repository->listAll();

        foreach ($all_orders as $order) {
            foreach ($order->getProductsOrders() as $item) {
                if ($item->getProductId() === $id) {
                    throw new Exception("Erro: Nao e possivel deletar um produto vinculado a um pedido existente", 400);
                }
            }
        }

        $this->product_repository->delete($id);
    }
}