<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{
    /*** @var CategoryRepositoryInterface */
    protected $categoryRepository;

    /*** @var TenantRepositoryInterface */
    protected $tenantRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param TenantRepositoryInterface $tenantRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getCategoriesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getCategoryByUuid(string $uuid)
    {
        return $this->categoryRepository->getCategoryByUuid($uuid);
    }
}
