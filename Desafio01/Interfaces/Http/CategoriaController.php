<?php
namespace Interfaces\Http;

use App\Categoria\Infrastructure\MemoryCategoriaRepository;
use App\Categoria\UseCases\CreateCategoriaUseCase;
use Exception;

class CategoriaController 
{
    public function create(): void 
    {
        $json = file_get_contents("php://input");
        $content = json_decode($json, true);

        try {

            $repository = new MemoryCategoriaRepository();
            $useCase = new CreateCategoriaUseCase($repository);
            
            $nomeRecebido = $content['nome'] ?? '';
            $useCase->execute($nomeRecebido);

            http_response_code(201);
            echo json_encode(["Sucesso" => "Categoria criada com sucesso."]);

        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Erro" => $e->getMessage()]);
        }
    }
}