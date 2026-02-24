<?php

namespace App\Movimentacao\Infrastructure;

use App\Movimentacao\MovimentacaoRepositoryInterface;
use App\Movimentacao\Domain\Movimentacao;

class MemoryMovimentacaoRepository implements MovimentacaoRepositoryInterface
{
    public function __construct()
    {
        if (!isset($_SESSION['moviment'])) {
            $_SESSION['moviment'] = [];
        }
    }
    

    public function save(Movimentacao $moviment):void
    {
        $id = uniqid();
        $moviment->setId($id);
        $_SESSION['moviment'][] = $moviment;
    }

    public function listAll():array
    {
        return $_SESSION['moviment'];
    }
}