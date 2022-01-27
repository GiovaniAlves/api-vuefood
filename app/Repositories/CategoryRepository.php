<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

/**
 *
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /*** @var Category */
    protected $entity;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getCategoriesByTenantUuid(string $uuid)
    {
       return $this->entity
           ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
           ->where('tenants.uuid', $uuid)
           ->select('categories.*')
           ->get();
    }

    /**
     * @param int $tenantId
     * @return mixed
     */
    public function getCategoriesByTenantId(int $tenantId)
    {
        return $this->entity->where('tenant_id', $tenantId)->get();
    }
}
