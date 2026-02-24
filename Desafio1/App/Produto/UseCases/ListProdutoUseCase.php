<?php

namespace App\Produto\UseCases;

use App\Produto\ProdutoRepositoryInterface;

class ListProdutoUseCase
{
    private ProdutoRepositoryInterface $repository;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute():array
    {
        return $this->repository->listAll();
    }
}