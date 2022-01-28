<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantIdAndCategories(int $tenantId, array $categories);
    public function getProductByFlag(string $flag);
}
