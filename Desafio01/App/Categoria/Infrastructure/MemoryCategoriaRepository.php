<?php

namespace App\Categoria\Infrastructure;

use App\Categoria\CategoriaRepositoryInterface;
use App\Categoria\Domain\Categoria;

class MemoryCategoriaRepository implements CategoriaRepositoryInterface
{
    public function __construct()
    {
        if (!isset($_SESSION['category'])) {
            $_SESSION['category'] = [];
        }
    }

    public function save(Categoria $category):void
    {
        $new_id = uniqid();
        $category->setId($new_id);

        $_SESSION['category'][] = $category;
    }   

    public function listAll(): array
    {
        return $_SESSION['category'];
    }
    public function getById(string $id): ?Categoria
    {
        foreach($_SESSION['category'] as $category)
            {
                if ($category->getId() === $id)
                    {
                        return $category;
                    }
                    
            }
        return null;
    }

    public function update($updated_category):void
    {
        foreach($_SESSION['category'] as $index => $saved_category)
            {
                if($saved_category->getId()=== $updated_category->getId())
                    {
                        $_SESSION['category'][$index] = $updated_category;
                        break;
                    }
            }
    }

    public function delete(string $id):void
    {
        foreach($_SESSION['category'] as $index => $category)
            {
                if($category->getId() === $id)
                    {
                        unset($_SESSION['category'][$index]);
                        $_SESSION['category'] = array_values($_SESSION['category']);
                        break;            
                    }
            }
    }
}