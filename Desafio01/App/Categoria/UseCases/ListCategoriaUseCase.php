<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;

class ListCategoriaUseCase
{
    private CategoriaRepositoryInterface $repository;

    function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function execute(): array
    {
        $lista = $this->repository->listAll();

        return $lista;
    }
}
