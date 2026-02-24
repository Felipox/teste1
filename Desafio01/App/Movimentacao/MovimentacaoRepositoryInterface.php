<?php

namespace App\Movimentacao;

use App\Movimentacao\Domain\Movimentacao;
interface MovimentacaoRepositoryInterface
{
    function save(Movimentacao $moviment): void;
    function listAll(): array;
}
