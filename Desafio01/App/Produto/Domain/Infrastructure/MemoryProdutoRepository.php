<?php

namespace App\Produto\Domain\Infrastructure;

use App\Produto\Domain\Produto;
use App\Produto\ProdutoRepositoryInterface;

class MemoryProdutoRepository implements ProdutoRepositoryInterface
{
    public function __construct()
    {
        if(!isset($_SESSION['products']))
            {
                $_SESSION['products'] = [];
            }
    }

    public function save(Produto $product):void
    {
        $new_id = uniqid();
        $product->setId($new_id);
        $_SESSION['products'][$new_id] = $product;
    }
    public function listAll():array
    {
        return $_SESSION['products'];
    }

    public function getById(string $wanted_id):?Produto
    {
        foreach($_SESSION['products'] as $product)
            {
                if($product->getId() === $wanted_id)
                    {
                        return $product;
                    }
            }
            return null;
    }

    public function update(Produto $updated_product):void
    {
        foreach($_SESSION['products'] as $index => $product)
            {
                if($product->getId() === $updated_product->getId())
                    {
                        $_SESSION['products'][$index] = $updated_product;
                    }
            }
    }

    public function delete(string $delete_id):void
    {
        foreach($_SESSION['products'] as $index => $product)
            {
                if($product->getId()=== $delete_id)
                    {
                        unset($_SESSION['products'][$index]);
                        $_SESSION['products'] = array_values($_SESSION['products']);
                        break;    
                    }
            }
    }
}