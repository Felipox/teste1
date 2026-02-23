<?php

namespace Interfaces\Http;

class PedidosController
{
    public function create()
    {
        http_response_code(201);
        echo json_encode(["Sucesso"=>"Pedido criado com sucesso."]);
    }
}