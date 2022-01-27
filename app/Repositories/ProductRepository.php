<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /*** @var Product */
    protected $entity;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    /**
     * @param int $tenantId
     * @return mixed
     */
    public function getProductsByTenantId(int $tenantId)
    {
        return $this->entity->where('tenant_id', $tenantId)->get();
    }
}
