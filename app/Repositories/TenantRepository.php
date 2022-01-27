<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    /*** @var Tenant */
    protected $entity;

    /**
     * @param Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }

    /**
     * @return Tenant[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllTenants()
    {
        return $this->entity->paginate();
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getTenantByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->firstOrfail();
    }
}
