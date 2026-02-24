<?php

use Interfaces\Http\CategoriaController;
use Interfaces\Http\PedidosController;
use Interfaces\Http\ProdutoController;

$json = file_get_contents("php://input");
$content = json_decode($json, true) ?? []; 

switch ($url) {
    case '/categorias':
        $controller = new CategoriaController();
        
        switch ($method) {
            case 'POST':
                $controller->create($content);
                break;
            case 'GET':
                if(isset($_GET['id']))
                {
                $controller->getById();
                }
                else
                {
                $controller->listAll();
                }   
                break;
            case 'PUT':
                $controller->update($content);
                break;
            case 'DELETE':
                $controller->delete();
                break;
            default:
                http_response_code(405);
                echo json_encode(["Erro: Método não permitido para Categorias."]);
                break;
        }
        break;

    case '/produtos':
        $controller = new ProdutoController();

        switch ($method) {
            case 'POST':
                $controller->create($content);
                break;
            case 'GET':
                if(isset($_GET['id']))
                {
                $controller->getById();
                }
                else
                {
                $controller->listAll();
                } 
                break;
            case 'PUT':
                $controller->update($content);
                break;
            case 'DELETE':
                $controller->delete();
                break;
            default:
                http_response_code(405);
                echo json_encode(["Erro: Método não permitido para Produtos."]);
                break;
        }
        break;

    case '/pedidos':
        $controller = new PedidosController();

        switch ($method) {
            case 'POST':
                $controller->create($content);
                break;
            case 'GET':
                if(isset($_GET['id']))
                {
                $controller->getById();
                }
                else
                {
                $controller->listAll();
                } 
                break;
            case 'PUT':
                $controller->update($content);
                break;
            case 'DELETE':
                $controller->delete();
                break;
            default:
                http_response_code(405);
                echo json_encode(["Erro Método não permitido para Pedidos."]);
                break;
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["Erro Rota não encontrada."]);
        break;
}