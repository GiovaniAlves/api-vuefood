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

    /**
     * @param int $orderId
     * @param int $clientId
     * @param array $evaluation
     * @return mixed
     */
    public function storeNewEvaluationOrder(int $orderId, int $clientId, array $evaluation)
    {
        $data = [
          'order_id' => $orderId,
          'client_id' => $clientId,
          'stars' => $evaluation['stars'],
          'comment' => $evaluation['comment'] ?? ''
        ];

        return $this->entity->create($data);
    }

    /**
     * @param int $orderId
     * @return mixed
     */
    public function getEvaluationsByOrder(int $orderId)
    {
        return $this->entity->where('order_id', $orderId)->get();
    }

    /**
     * @param int $clientId
     * @return mixed
     */
    public function getEvaluationsByClient(int $clientId)
    {
        return $this->entity->where('client_id', $clientId)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getEvaluationById(int $id)
    {
        return $this->entity->find($id);
    }

    /**
     * @param int $clientId
     * @param int $orderId
     * @return mixed
     */
    public function getEvaluationByClientAndOrder(int $clientId, int $orderId)
    {
        return $this->entity
            ->where('client_id', $clientId)
            ->where('order_id', $orderId)
            ->firstOrFail();
    }
}
