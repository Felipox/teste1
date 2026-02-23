<?php

use Interfaces\Http\CategoriaController;
use Interfaces\Http\PedidosController;
use Interfaces\Http\ProdutoController;

if ( ($method === 'POST') && ($url === '/categorias')){
    $controller = new CategoriaController();
    $controller->create();
    exit;
}
if(($method === 'POST') && ($url === '/pedidos')){
    $controller = new PedidosController();
    $controller->create();
    exit;
}
if(($method === 'POST') && ($url === '/produtos')){
    $controller = new ProdutoController();
    $controller->create();
    exit;
}

http_response_code(404);
echo json_encode(["Erro"=>"Rota nao encontrada."]);
