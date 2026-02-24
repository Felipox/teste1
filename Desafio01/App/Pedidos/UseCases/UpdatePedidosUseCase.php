<?php

namespace App\Pedidos\UseCases;

use App\Pedidos\PedidosRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use App\Pedidos\Domain\ProdutosPedidos;
use App\Pedidos\Domain\Pedidos;
use Exception;

class UpdatePedidosUseCase
{
    private PedidosRepositoryInterface $order_repository;
    private ProdutoRepositoryInterface $product_repository;

    public function __construct(PedidosRepositoryInterface $order_repository, ProdutoRepositoryInterface $product_repository)
    {
        $this->order_repository = $order_repository;
        $this->product_repository = $product_repository;
    }
    public function execute(string $id, array $updated_content): void
    {
        $order = $this->order_repository->getById($id);

        if($order === null)
        {
            throw new Exception("Erro: Pedido nao encontrado", 404);
        }
        
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
        
        if(empty($updated_content))
        {
            throw new Exception("Erro: Nenhum produto foi informado", 400);
        }
        
        $list_new_items = [];

        foreach($updated_content as $item)
        {
            if($item['quantity'] <= 0)
            {
                throw new Exception("Erro: Quantidade do produto deve ser maior que zero", 400);
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

            $list_new_items[] = new ProdutosPedidos(
                product_id: $item['product_id'],
                quantity: $item['quantity'],
                unit_price: $product->getPrice()
            );
        }
        $updated_order = new Pedidos(
            products_orders: $list_new_items,
            id: $id,
            date_time: $order->getDateTime()
        );

        $this->order_repository->update($updated_order);
    }
}