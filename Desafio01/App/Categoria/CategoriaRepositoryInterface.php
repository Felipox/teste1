<?php

namespace App\Categoria;

use App\Categoria\Domain\Categoria;

Interface CategoriaRepositoryInterface
{
    function save(Categoria $categorie): void;
    function listAll(): array;
    function getById(string $id): ?Categoria;

}