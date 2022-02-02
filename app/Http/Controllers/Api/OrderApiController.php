<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderFormRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;


class OrderApiController extends Controller
{
    /*** @var OrderService */
    protected $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param StoreOrderFormRequest $request
     * @return OrderResource
     */
    public function store(StoreOrderFormRequest $request)
    {
        $order = $this->orderService->createNewOrder($request->all());

        return new OrderResource($order);
    }

    /**
     * @param string $identify
     * @return OrderResource
     */
    public function show(string $identify)
    {
        // Validei dessa forma pq o metodo getOrderByIdentify também está sendo usado no método create.
        if (!$order = $this->orderService->getOrderByIdentify($identify)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return new OrderResource($order);
    }
}
