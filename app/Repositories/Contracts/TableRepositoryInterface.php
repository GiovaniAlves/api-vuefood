<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantId(int $tenantId);
    public function getTableByIdentify(string $identify);
}
