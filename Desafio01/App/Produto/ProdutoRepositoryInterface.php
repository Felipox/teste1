<?php

namespace App\Produto;

use App\Produto\Domain\Produto;

Interface ProdutoRepositoryInterface
{
    function save(Produto $product):void;
    function listAll():array;
    function getById(string $id):?Produto;
    function update(Produto $updated_product):void;
    function delete(string $delete_id):void;

}