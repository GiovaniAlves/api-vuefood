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
     * @param array $categories
     * @return mixed
     */
    public function getProductsByTenantIdAndCategories(int $tenantId, array $categories)
    {
        return $this->entity
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->where('products.tenant_id', $tenantId)
            ->where('categories.tenant_id', $tenantId)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.url', $categories);
                }
            })
            ->get();
    }

    /**
     * @param string $flag
     * @return mixed
     */
    public function getProductByFlag(string $flag)
    {
        return $this->entity->where('flag', $flag)->firstOrFail();
    }
}
