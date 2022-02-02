<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function storeNewEvaluationOrder(int $orderId, int $clientId, array $evaluation);
    public function getEvaluationsByOrder(int $orderId);
    public function getEvaluationsByClient(int $clientId);
    public function getEvaluationById(int $id);
    public function getEvaluationByClientAndOrder(int $clientId, int $orderId);
}
