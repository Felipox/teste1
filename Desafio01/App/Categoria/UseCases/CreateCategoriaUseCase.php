<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;
use Exception;

class CreateCategoriaUseCase
{
    private CategoriaRepositoryInterface $repository;

public function __construct(CategoriaRepositoryInterface $repository)
{
    $this->repository = $repository;
}

public function execute(string $name): void
{
    if($name=== '')
        {
            throw new Exception('Erro: O nome da categoria nao pode ser vazio', 400);
        }
    $category = new Categoria($name);
    $this->repository->save($category);
}
}