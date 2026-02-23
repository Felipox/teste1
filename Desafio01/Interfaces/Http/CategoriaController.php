<?php
namespace Interfaces\Http;

use App\Categoria\Infrastructure\MemoryCategoriaRepository;
use App\Categoria\UseCases\CreateCategoriaUseCase;
use Exception;
use App\Categoria\UseCases\ListCategoriaUseCase;
use App\Categoria\Usecases\GetCategoriaByIdUseCase;

class CategoriaController 
{
    public function create(): void 
    {
        $json = file_get_contents("php://input");
        $content = json_decode($json, true);

        try {

            $repository = new MemoryCategoriaRepository();
            $use_case = new CreateCategoriaUseCase($repository);
            
            $name_received = $content['name'] ?? '';
            $use_case->execute($name_received);

            http_response_code(201);
            echo json_encode(["Sucesso" => "Categoria criada com sucesso."]);

        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Erro" => $e->getMessage()]);
        }

    }

    public function listAll(): void
    {
        try
        {
            $repository = new MemoryCategoriaRepository();
            $use_case = new ListCategoriaUseCase($repository);

            $categories = $use_case->execute();

                $answer = [];
            foreach($categories as $category)
                {
                    $answer[]=[
                    "id"=> $category->getId(),
                    "name"=> $category->getName()
                    ];
                }
                http_response_code(200);
                echo json_encode($answer);
        }
        catch (\Throwable $e)
        {
            http_response_code(500);
            echo json_encode([
                "Erro" => "Ocorreu um erro ao listar as categorias.",
                "Motivo" => $e->getMessage(),
                "Arquivo" => $e->getFile(),
                "Linha" => $e->getLine()
            ]);;
        }
    }

    public function getById(): void
    {
        try
        {
            $received_id = $_GET['id'];

            $repository = new MemoryCategoriaRepository();
            $use_case = new GetCategoriaByIdUseCase($repository);

            $categorie = $use_case->execute($received_id);
            
            $answer = [
                'id'=> $categorie->getId(),
                'name'=> $categorie->getName()
            ];
            http_response_code(200);
            echo json_encode($answer);
        }catch (Exception $e)
        {
            http_response_code($e->getCode());
            echo json_encode(["Erro" => $e->getMessage()]);
        }
    }
}