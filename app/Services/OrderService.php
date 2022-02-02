<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    /*** @var OrderRepositoryInterface */
    protected $orderRepository;

    /*** @var TenantRepositoryInterface */
    protected $tenantRepository;

    /*** @var TableRepositoryInterface */
    protected $tableRepository;

    /*** @var ProductRepositoryInterface */
    protected $productRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param TenantRepositoryInterface $tenantRepository
     * @param TableRepositoryInterface $tableRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        OrderRepositoryInterface   $orderRepository,
        TenantRepositoryInterface  $tenantRepository,
        TableRepositoryInterface   $tableRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    /**
     * @param array $order
     * @return mixed
     */
    public function createNewOrder(array $order)
    {
        $products = $this->getProducts($order['products'] ?? []);

        $identify = $this->generateIdentifyOrder();
        $total = $this->calcTotalOrder($products);
        $status = 'open';
        $tenantId = $this->getTenantId($order['token_company']);
        $comment = $order['comment'] ?? '';
        $clientId = $this->getClientId();
        $tableId = $this->getTabletId($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder($identify, $total, $tenantId, $status, $comment, $clientId, $tableId);

        // Cadastrando na table order_product
        $this->orderRepository->registerProductsOrder($order->id, $products);

        return $order;
    }

    /**
     * @param int $qtyCaracters
     * @return string
     */
    private function generateIdentifyOrder(int $qtyCaracters = 8): string
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $caracters = $smallLetters . $numbers;

        $identify = substr(str_shuffle($caracters), 0, $qtyCaracters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->generateIdentifyOrder($qtyCaracters + 1);
        }

        return $identify;
    }

    /**
     * @param array $productsOrder
     * @return array
     */
    private function getProducts(array $productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);

            $products[] = [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price
            ];
        }

        return $products;
    }

    /**
     * @param array $products
     * @return float
     */
    private function calcTotalOrder(array $products): float
    {
        $total = 0;

        foreach ($products as $product) {
            $total += ($product['price'] * $product['qty']);
        }

        return floatval($total);
    }

    /**
     * @param string $uuid
     * @return int
     */
    private function getTenantId(string $uuid): int
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $tenant->id;
    }

    /**
     * @param string $uuid
     * @return string
     */
    private function getTabletId(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);

            return $table->id;
        }

        return '';
    }

    /**
     * @return string
     */
    private function getClientId()
    {
        $client = auth()->check() ? auth()->user()->id : '';

        return $client;
    }
}
