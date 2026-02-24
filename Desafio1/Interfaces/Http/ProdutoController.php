<?php

namespace Interfaces\Http;

use App\Produto\Domain\Infrastructure\MemoryProdutoRepository;
use App\Produto\UseCases\CreateProdutoUseCase;
use App\Categoria\Infrastructure\MemoryCategoriaRepository;

class ProdutoController
{
    public function create()
    {
        try
        {
            $repositoryProduct = new MemoryProdutoRepository();
            $repositoryCategory = new MemoryCategoriaRepository();
            $produto = new CreateProdutoUseCase($repositoryProduct, $repositoryCategory);

            

        }
      
    }
}