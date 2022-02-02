<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(string $identify, float $total, int $tenantId, $status = 'open', $comment = '', $clientId = '', $tableId = '');
    public function getOrderByIdentify(string $identify);
    public function registerProductsOrder(int $orderId, array $products);
}
