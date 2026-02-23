<?php

namespace Interfaces\Http;

class ProdutoController
{
    public function create()
    {
        http_response_code(201);
        echo json_encode(["Sucesso"=>"Produto criado com sucesso."]);
    }
}