<?php

namespace App\Categoria\UseCases;

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;
use Exception;
class GetCategoriaByIdUseCase
{
    private CategoriaRepositoryInterface $repository;
    public function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): Categoria
    {
        $found_category = $this->repository->getById($id);
        if($found_category === null)
            {
                throw new Exception("Erro: Categoria nao encontrada", 404);
            }
        else
            {
                return $found_category;
            }
    }
}