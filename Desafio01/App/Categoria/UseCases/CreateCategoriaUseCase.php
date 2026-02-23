<?php

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;

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
    $categorie = new Categoria($name);
    $this->repository->save($categorie);
}
}