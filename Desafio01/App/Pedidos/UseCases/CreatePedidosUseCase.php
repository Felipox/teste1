<?php

namespace App\Pedidos\UseCases;

use App\Pedidos\PedidosRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use App\Pedidos\Domain\ProdutosPedidos;
use App\Pedidos\Domain\Pedidos;
use Exception;

class CreatePedidosUseCase
{
    private PedidosRepositoryInterface $order_repository;
    private ProdutoRepositoryInterface $product_repository;

    public function __construct(PedidosRepositoryInterface $order_repository, ProdutoRepositoryInterface $product_repository)
    {
        $this->order_repository = $order_repository;
        $this->product_repository = $product_repository;
    }

    public function execute(array $products_orders)
    {
        if(empty($products_orders))
            {
                throw new Exception("Erro: Nenhum produto foi informado",400);
            }
        
        $list_products_orders = [];

        foreach($products_orders as $item)
            {
                if($item['quantity'] <= 0)
                    {
                        throw new Exception("Erro: Quantidade do produto deve ser maior que zero ", 400);
                    }

                $product = $this->product_repository->getById($item['product_id']);
                
                if($product === null)
                    {
                        throw new Exception("Erro: ID do produto nao encontrado", 404);
                    }
                if($item['quantity'] > $product->getQuantity())
                    {
                        throw new Exception("Erro: Quantidade do produto excede o estoque disponível", 400);
                    }



                $new_quantity = $product->getQuantity() - $item['quantity'];
                $product->setQuantity($new_quantity);
                $this->product_repository->update($product);

                $list_products_orders[] = new ProdutosPedidos(
                    product_id: $item['product_id'],
                    quantity: $item['quantity'],
                    unit_price: $product->getPrice()
                );
                }
                $new_order = new Pedidos(products_orders:$list_products_orders);
                $this->order_repository->save($new_order);
                
    }
}   