<?php

namespace App\Categoria\Infrastructure;

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;

class MemoryCategoriaRepository implements CategoriaRepositoryInterface
{
    private static array $categories = [];

    public function save(Categoria $categorie):void
    {
        $new_id = uniqid();
        $categorie->getId($new_id);

        self::$categories[] = $categorie;
    }

    public function listAll(): array
    {
        return self::$categories;
    }
}