<?php

namespace App\Categoria\Infrastructure;

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;

class MemoryCategoriaRepository implements CategoriaRepositoryInterface
{
    public function __construct()
    {
        if (!isset($_SESSION['categories'])) {
            $_SESSION['categories'] = [];
        }
    }

    public function save(Categoria $categorie):void
    {
        $new_id = uniqid();
        $categorie->setId($new_id);

        $_SESSION['categories'][] = $categorie;
    }   

    public function listAll(): array
    {
        return $_SESSION['categories'];
    }
    public function getById(string $id): ?Categoria
    {
        foreach($_SESSION['categories'] as $categorie)
            {
                if ($categorie->getId() === $id)
                    {
                        return $categorie;
                    }
                    
            }
        return null;
    }
}