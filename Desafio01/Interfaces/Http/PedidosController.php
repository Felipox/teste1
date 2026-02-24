<?php

namespace Interfaces\Http;

use App\Pedidos\Domain\Infrastructure\MemoryPedidosRepository;
use App\Pedidos\UseCases\CreatePedidosUseCase;
use App\Pedidos\UseCases\GetPedidoByIdUseCase;
use App\Produto\Domain\Infrastructure\MemoryProdutoRepository;
use App\Pedidos\UseCases\ListPedidosUseCase;
use App\Pedidos\UseCases\DeletePedidosUseCase;
use App\Pedidos\UseCases\UpdatePedidosUseCase;
use Exception;

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
        catch (Exception $e)
        {
            http_response_code($e->getCode() ?: 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function listAll():void
    {
        try
        {
            $repository = new MemoryPedidosRepository();
            $use_case = new ListPedidosUseCase($repository);

            $orders = $use_case->execute();

            $answer = [];
            foreach ($orders as $order) 
            {
                $items_array = [];
                foreach ($order->getProductsOrders() as $item) {
                    $items_array[] = [
                        "product_id" => $item->getProductId(),
                        "quantity" => $item->getQuantity(),
                        "unit_price" => $item->getUnitPrice()
                    ];
                }

                $answer[] = [
                    "id" => $order->getId(),
                    "date_time" => $order->getDateTime(),
                    "total_price" => $order->getValorTotal(),
                    "items" => $items_array
                ];
            }
            http_response_code(200);
            echo json_encode($answer);
        }
        catch (Exception $e)
        {
            http_response_code(500);
            echo json_encode(["Erro"=> $e->getMessage()]);
        }
    }

    public function getById():void
    {
        try
        {
            $received_id = $_GET['id'];

            $repository = new MemoryPedidosRepository();
            $use_case = new GetPedidoByIdUseCase($repository);

            $order = $use_case->execute($received_id);

            $answer = [];
            
            
                $items_array = [];
                foreach ($order->getProductsOrders() as $item) {
                    $items_array[] = [
                        "product_id" => $item->getProductId(),
                        "quantity" => $item->getQuantity(),
                        "unit_price" => $item->getUnitPrice()
                    ];
                }

                $answer = [
                    "id" => $order->getId(),
                    "date_time" => $order->getDateTime(),
                    "total_price" => $order->getValorTotal(),
                    "items" => $items_array
                ];
            
            http_response_code(200);
            echo json_encode($answer);
        }
        catch (Exception $e)
        {
            http_response_code(500);
            echo json_encode(["Erro"=> $e->getMessage()]);
        }
        }

        public function update(array $updated_content):void
        {
            try
            {

            $received_id = $_GET["id"];
            if($received_id=== '')
                {
                    throw new Exception("Erro: ID nao informado",400);
                }

            $order_repository = new MemoryPedidosRepository();
            $product_repository = new MemoryProdutoRepository();

            $use_case = new UpdatePedidosUseCase($order_repository,$product_repository);

            $use_case->execute($received_id,$updated_content);

            http_response_code(200);
            echo json_encode(["Sucesso: Pedido atualizado com sucesso"]);
            }
        catch(Exception $e)
        {
            http_response_code($e->getCode()?:500);
            echo json_encode(["Erro"=> $e->getMessage()]);
        }
        }

        public function delete():void
        {
            try
            {
            $received_id = $_GET['id'];

            $order_repository = new MemoryPedidosRepository();
            $product_repository = new MemoryProdutoRepository();
            $use_case = new DeletePedidosUseCase($order_repository, $product_repository);

            $use_case->execute($received_id);

            http_response_code(200);
            echo json_encode(["Sucesso: Pedido deletada com sucesso"]);
            }
        catch(Exception $e)
            {
            http_response_code($e->getCode()?:500);
            echo json_encode(["Erro"=> $e->getMessage()]);
            }
        }
    }
