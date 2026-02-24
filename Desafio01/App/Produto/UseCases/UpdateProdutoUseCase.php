<?php

namespace App\Produto\UseCases;

use App\Produto\ProdutoRepositoryInterface;
use Exception;

class UpdateProdutoUseCase
{
    private ProdutoRepositoryInterface $repository;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id, string $new_name, string $new_category_id, int $new_price, int $new_quantity):void
    {
        if($new_name === '')
                {
                    throw new Exception('Erro: Nome do produto nao pode ser vazio', 400);
                }
            if($new_price <= 0)
                {
                    throw new Exception('Erro: Preco do produto deve ser maior que zero', 400);
                }
            if($new_quantity <= 0)
                {
                    throw new Exception("Erro: Quantidade do produto deve ser maior que zero", 400);
                }
            
            $produto = $this->repository->getById($id);

            if($produto === null)
            {
                throw new Exception("Erro: Produto nao encontrado", 404);
            }

            $produto->setName($new_name);
            $produto->setCategory($new_category_id);
            $produto->setPrice($new_price);
            $produto->setQuantity($new_quantity);
            
            $this->repository->update($produto);
    }
}