<?php

namespace App\Categoria;

use App\Categoria\Domain\Categoria;

Interface CategoriaRepositoryInterface
{
    function save(Categoria $category): void;
    function listAll(): array;
    function getById(string $id): ?Categoria;

    function update($updated_category);
}