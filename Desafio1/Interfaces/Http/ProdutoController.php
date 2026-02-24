<?php

namespace Interfaces\Http;

use App\Produto\Domain\Infrastructure\MemoryProdutoRepository;
use App\Produto\UseCases\CreateProdutoUseCase;
use App\Categoria\Infrastructure\MemoryCategoriaRepository;
use App\Produto\UseCases\ListProdutoUseCase;
use App\Produto\UseCases\GetProdutoByIdUseCase;
use Exception;

class ProdutoController
{
    public function create(array $content)
    {
        try
        {
            $repositoryProduct = new MemoryProdutoRepository();
            $repositoryCategory = new MemoryCategoriaRepository();
            $produto = new CreateProdutoUseCase($repositoryProduct, $repositoryCategory);
    
            $produto->execute(
                name:$content['name'],
                category_id:$content['category_id'],
                price:$content['price'],
                quantity:$content['quantity']
            );
            http_response_code(201);
            echo json_encode(["Sucesso" => "Produto criado com sucesso."]);
        }
        catch(\Exception $e)
        {
            http_response_code($e->getCode() ?: 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function listAll()
    {
        try
        {
            $repository = new MemoryProdutoRepository();
            $use_case = new ListProdutoUseCase($repository);
            $products = $use_case->execute();
            
            $answer = [];
            foreach($products as $product)
                {
                    $answer[]=[
                    "id" => $product->getId(),
                    "name" => $product->getName(),
                    "price" => $product->getPrice(),
                    "category_id" => $product->getCategoryId(),
                    "quantity" => $product->getQuantity()
                    ];
                }
            http_response_code(200);
            echo json_encode($answer);
        }
        catch(\Throwable $e)
        {
            http_response_code($e->getCode() ?: 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getById()
    {
        try
        {
            $received_id = $_GET['id'];

            $repository = new MemoryProdutoRepository();
            $use_case = new GetProdutoByIdUseCase($repository);

            $product = $use_case->execute($received_id);
            
            $answer = [
                'id'=> $product->getId(),
                'name'=> $product->getName(),
                'price'=> $product->getPrice(),
                'category_id'=> $product->getCategoryId(),
                'quantity'=> $product->getQuantity()
            ];
            http_response_code(200);
            echo json_encode($answer);
        }catch (Exception $e)
        {
            http_response_code($e->getCode()?:500);
            echo json_encode(["Erro" => $e->getMessage()]);
        }
    }
}