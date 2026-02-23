<?php

use Interfaces\Http\CategoriaController;
use Interfaces\Http\PedidosController;
use Interfaces\Http\ProdutoController;

    $json = file_get_contents("php://input");
    $content = json_decode($json, true);

    if ( ($method === 'POST') && ($url === '/categorias'))
    {
    $controller = new CategoriaController();
    $controller->create($content);
    exit;
    }

    if(($method === 'GET') && ($url === '/categorias'))
    {
    $controller = new CategoriaController();
    
    if(isset($_GET['id']))
        {
            $controller->getById();
        }
    else
        {
            $controller->listAll();
        }
    exit;
    }

    if(($method === 'PUT') && ($url === '/categorias'))
        {
            $controller = new CategoriaController();
            $controller->update($content);
        }

    if(($method === 'POST') && ($url === '/pedidos'))
    {
    $controller = new PedidosController();
    $controller->create();
    exit;
    }

    if(($method === 'POST') && ($url === '/produtos'))
    {
    $controller = new ProdutoController();
    $controller->create();
    exit;
    }

http_response_code(404);
echo json_encode(["Erro"=>"Rota nao encontrada."]);
