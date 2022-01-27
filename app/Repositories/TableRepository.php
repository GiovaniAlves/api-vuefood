<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableRepository implements TableRepositoryInterface
{
    /*** @var Table */
    protected $entity;

    /**
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->entity = $table;
    }

    /**
     * @param int $tenantId
     * @return mixed
     */
    public function getTablesByTenantId(int $tenantId)
    {
        return $this->entity->where('tenant_id', $tenantId)->get();
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function getTableByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->firstOrFail();
    }
}
