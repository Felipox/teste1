<?php

namespace App\Produto\UseCases;

use App\Produto\ProdutoRepositoryInterface;
use Exception;

class DeleteProdutoUseCase
{
    private ProdutoRepositoryInterface $repository;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id):void
    {
        $category = $this->repository->getById($id);

        if($category === null)
            {
                throw new Exception("Erro: Produto nao encontrado",404);
            }
        else
            {
                $this->repository->delete($id);
            }
    }
}