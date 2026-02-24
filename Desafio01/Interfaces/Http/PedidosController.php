<?php

namespace Interfaces\Http;

use App\Pedidos\Domain\Infrastructure\MemoryPedidosRepository;
use App\Pedidos\UseCases\CreatePedidosUseCase;
use App\Produto\Domain\Infrastructure\MemoryProdutoRepository;

class PedidosController
{
    public function create(array $content)
    {
        try
        {
            $order_repository = new MemoryPedidosRepository();
            $product_repository = new MemoryProdutoRepository();
            $use_case = new CreatePedidosUseCase($order_repository, $product_repository);
            
            $use_case->execute($content);

            http_response_code(200);
            echo json_encode("Sucesso: Pedido criado com sucesso");
        }
        catch (\Exception $e)
        {
            http_response_code($e->getCode() ?: 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}