<?php

namespace App\Services;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

/**
 *
 */
class ProductService
{
    /*** @var ProductRepositoryInterface */
    protected $productRepository;

    /*** @var TenantRepositoryInterface */
    protected $tenantRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param TenantRepositoryInterface $tenantRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }


    /**
     * @param string $uuid
     * @param array $categories
     * @return mixed
     */
    public function getProductsByTenantUuidAndCategories(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenantIdAndCategories($tenant->id, $categories);
    }

    public function getProductByFlag(string $flag)
    {
        return $this->productRepository->getProductByFlag($flag);
    }
}
