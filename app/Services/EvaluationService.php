<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    /*** @var EvaluationRepositoryInterface */
    protected $evaluationRepository;

    /*** @var OrderRepositoryInterface */
    protected $orderRepository;

    /**
     * @param EvaluationRepositoryInterface $evaluationRepository
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(EvaluationRepositoryInterface $evaluationRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param string $identifyOrder
     * @param array $evaluation
     * @return mixed
     */
    public function storeNewEvaluationOrder(string $identifyOrder, array $evaluation)
    {
        $clientId = auth()->user()->id;
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->storeNewEvaluationOrder($order->id, $clientId, $evaluation);
    }
}
