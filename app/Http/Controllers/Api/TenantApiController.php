<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

/**
 *
 */
class TenantApiController extends Controller
{
    /**
     * @var TenantService
     */
    protected $tenantService;

    /**
     * @param TenantService $tenantService
     */
    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TenantResource::collection($this->tenantService->getAllTenants());
    }

    /**
     * @param String $uuid
     * @return TenantResource
     */
    public function show(String $uuid)
    {
        $tenant = $this->tenantService->getTenantByUuid($uuid);

        return new TenantResource($tenant);
    }
}
