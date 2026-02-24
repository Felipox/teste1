<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use App\Produto\ProdutoRepositoryInterface;
use Exception;

class DeleteCategoriaUseCase
{
    private CategoriaRepositoryInterface $category_repository;
    private ProdutoRepositoryInterface $product_repository;

    public function __construct(CategoriaRepositoryInterface $category_repository, ProdutoRepositoryInterface $product_repository)
    {
        $this->category_repository = $category_repository;
        $this->product_repository = $product_repository;
    }

    public function execute(string $id):void
    {
        $category = $this->category_repository->getById($id);
        
        if($category === null)
            {
                throw new Exception("Erro: Categoria nao encontrada",404);
            }
            foreach($this->product_repository->listAll() as $product)
                {
                    if($product->getCategoryId()=== $category->getId())
                        {
                            throw new Exception("Erro: Categoria vinculada a um produto", 400);
                        }
                }
            
        $this->category_repository->delete($id);
                    
    }
}