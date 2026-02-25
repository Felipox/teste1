<?php

namespace Interfaces\Http;

use App\Movimentacao\Infrastructure\MemoryMovimentacaoRepository;
use Exception;

class MovimentacaoController
{
    public function listAll(): void
    {
        try {
            $repository = new MemoryMovimentacaoRepository();
            $movimentacoes = $repository->listAll();

            $answer = [];
            foreach ($movimentacoes as $m) {
                $answer[] = [
                    'id' => $m->getId(),
                    'product_id' => $m->getProductId(),
                    'order_id' => $m->getOrderId(),
                    'type' => $m->getType(),
                    'quantity' => $m->getQuantity(),
                    'reason' => $m->getReason(),
                    'date_time' => $m->getDateTime()
                ];
            }

            http_response_code(200);
            echo json_encode($answer);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["Erro" => $e->getMessage()]);
        }
    }
}