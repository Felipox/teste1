<?php

namespace App\Produto\UseCases;

use App\Produto\Domain\Produto;
use App\Produto\ProdutoRepositoryInterface;

class GetProdutoByIdUseCase
{
    private ProdutoRepositoryInterface $repository;

    public function __construct(ProdutoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): Produto
    {
        $found_produto = $this->repository->getById($id);
        if($found_produto === null) 
            {
                throw new \Exception("Erro: ID do produto nao encontrado", 404);
            }
            return $found_produto;
    }
}