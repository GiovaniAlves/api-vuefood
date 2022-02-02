<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    /*** @var Evaluation */
    protected $entity;

    /**
     * @param Evaluation $evaluation
     */
    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }

    public function storeEvaluationOrder(int $orderId, int $clientId)
    {
        // TODO: Implement storeEvaluationOrder() method.
    }

    public function getEvaluationsByOrder(int $orderId)
    {
        // TODO: Implement getEvaluationsByOrder() method.
    }

    public function getEvaluationsByClient(int $clientId)
    {
        // TODO: Implement getEvaluationsByClient() method.
    }
}
