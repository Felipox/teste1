<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use Exception;
class UpdateCategoriaUseCase
{
    private CategoriaRepositoryInterface $repository;
    public function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $new_name, string $id):void
    {
        if ($new_name == '')
            {
                throw new Exception("Nome invalido: O nome da categoria nao pode ser vazio", 400);
            }
        $category = $this->repository->getById($id);

        if($category === null)
            {
                throw new Exception("Erro: Categoria nao encontrada",404);
            }
            $category->setName($new_name);
            $this->repository->update($category);
    }
}