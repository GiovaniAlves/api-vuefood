<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository;
    protected $orderRepository;

    public function __construct(EvaluationRepositoryInterface $evaluationRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function storeNewEvaluation(string $identifyOrder)
    {
        $clientId = auth()->user()->id;
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->storeEvaluationOrder($order->id, $clientId);
    }
}
