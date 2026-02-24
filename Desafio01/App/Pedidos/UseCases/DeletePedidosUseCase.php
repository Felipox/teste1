<?php

namespace App\Pedidos\UseCases;

use App\Pedidos\PedidosRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use Exception;

class DeletePedidosUseCase
{
    private PedidosRepositoryInterface $order_repository;
    private ProdutoRepositoryInterface $product_repository;

    public function __construct(PedidosRepositoryInterface $order_repository, ProdutoRepositoryInterface $product_repository)
    {
        $this->repository = $order_repository;
        $this->product_repository = $product_repository;
    }

    public function execute(string $id):void
    {
        $order = $this->order_repository->getById($id);

        if($order === null)
            {
                throw new Exception("Erro: Pedido nao encontrado", 404);
            }
        else
            {
                $buyed_items = $order->getProductsOrders();
                foreach($buyed_items as $item)
                    {
                        $product_id = $item->getProductId();
                        $restore_qnt = $item->getQuantity();

                        $product = $this->product_repository->getById($product_id);

                        if ($product !== null) 
                {
                    $new_quantity = $product->getQuantity() + $restore_qnt;
                    $product->setQuantity($new_quantity);
                    $this->product_repository->update($product);
                }
                    }
                $this->order_repository->delete($id);
            }
    }
}