<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use Exception;

class DeleteCategoriaUseCase
{
    private CategoriaRepositoryInterface $repository;

    public function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id):void
    {
        $category = $this->repository->getById($id);

        if($category === null)
            {
                throw new Exception("Erro: Categoria nao encontrada",404);
            }
        else
            {
                $this->repository->delete($id);
            }
    }
}