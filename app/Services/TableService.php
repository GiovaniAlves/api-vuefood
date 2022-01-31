<?php

namespace App\Services;


use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService
{
    /*** @var TableRepositoryInterface */
    protected $tableRepository;

    /*** @var TenantRepositoryInterface */
    protected $tenantRepository;


    /**
     * @param TableRepositoryInterface $tableRepository
     * @param TenantRepositoryInterface $tenantRepository
     */
    public function __construct(TableRepositoryInterface $tableRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getTablesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }


    /**
     * @param string $uuid
     * @return mixed
     */
    public function getTableByUuid(string $uuid)
    {
        return $this->tableRepository->getTableByUuid($uuid);
    }
}
