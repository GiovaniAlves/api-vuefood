<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /*** @var Order */
    protected $entity;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    /**
     * @param string $identify
     * @param float $total
     * @param int $tenantId
     * @param $status
     * @param $comment
     * @param $clientId
     * @param $tableId
     * @return mixed
     */
    public function createNewOrder(string $identify, float $total, int $tenantId, $status = 'open', $comment = '', $clientId = '', $tableId = '')
    {
        $data = [
            'identify' => $identify,
            'total' => $total,
            'tenant_id' => $tenantId,
            'status' => $status,
            'comment' => $comment
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if ($tableId) $data['table_id'] = $tableId;

        $order = $this->entity->create($data);

        return $order;
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->first();
    }

    /**
     * @param int $orderId
     * @param array $products ['id - (product_id)', 'qty', 'price'] valores
     * @return void
     */
    public function registerProductsOrder(int $orderId, array $products)
    {
        $order = $this->entity->find($orderId);

        $orderProducts = [];

        // passo $key + 1 pq não posso enviar um array que começa na posição zero para cadastrar abaixo
        foreach ($products as $key => $product) {
            $orderProducts[$key + 1] = [
                'qty' => $product['qty'],
                'price' => $product['price']
            ];
        }

        // Cadastrando um conjunto de arrays na tabela order_product
        $order->products()->attach($orderProducts);
    }
}
