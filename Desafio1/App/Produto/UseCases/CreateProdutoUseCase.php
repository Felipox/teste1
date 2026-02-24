<?php

namespace App\Produto\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use Exception;
use App\Produto\Domain\Produto;


class CreateProdutoUseCase
{
    private ProdutoRepositoryInterface $repository_product;
    private CategoriaRepositoryInterface $category_repository;

    public function __construct(ProdutoRepositoryInterface $repository_product, CategoriaRepositoryInterface $category_repository)
    {
        $this->repository_product = $repository_product;
        $this->category_repository = $category_repository;
    }

    public function execute(string $name, string $category_id, int $price, int $quantity):void
    {
        
            if($name === '')
                {
                    throw new Exception('Erro: Nome do produto nao pode ser vazio', 400);
                }
            if($price <= 0)
                {
                    throw new Exception('Erro: Preco do produto deve ser maior que zero', 400);
                }
            if($quantity <= 0)
                {
                    throw new Exception("Erro: Quantidade do produto deve ser maior que zero", 400);
                }
            
            $category = $this->category_repository->getById($category_id);
            if($category === null)
                {
                    throw new Exception("Erro: Categoria nao encontrada", 404);
                }

        $product = new Produto($name, $price, $category_id, $quantity);
        $this->repository_product->save($product);
        
    }
}