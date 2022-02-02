<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function storeEvaluationOrder(int $orderId, int $clientId);
    public function getEvaluationsByOrder(int $orderId);
    public function getEvaluationsByClient(int $clientId);
}
