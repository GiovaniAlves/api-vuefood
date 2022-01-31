<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantIdAndCategories(int $tenantId, array $categories);
    public function getProductByUuid(string $uuid);
}
