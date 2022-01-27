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
     * @param $uuid
     * @return mixed
     */
    public function getProductsByTenantUuid($uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenantId($tenant->id);
    }
}
