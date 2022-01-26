<?php

namespace App\Services;

use App\Repositories\Contracts\TenantRepositoryInterface;

/**
 *
 */
class TenantService
{

    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;

    /**
     * @param TenantRepositoryInterface $repository
     */
    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->tenantRepository = $repository;
    }

    /**
     * @return mixed
     */
    public function getAllTenants()
    {
        return $this->tenantRepository->getAllTenants();
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getTenantByUuid(string $uuid)
    {
        return $this->tenantRepository->getTenantByUuid($uuid);
    }

}
