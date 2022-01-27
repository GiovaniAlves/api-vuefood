<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntityByTenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;

class TableApiController extends Controller
{

    /*** @var TableService */
    protected $tableService;

    /**
     * @param TableService $tableService
     */
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function tablesByTenant(EntityByTenantFormRequest $request)
    {
        $tables = $this->tableService->getTablesByUuid($request->token_company);

        return TableResource::collection($tables);
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @param $identify
     * @return TableResource
     */
    public function show(EntityByTenantFormRequest $request, $identify)
    {
        $table = $this->tableService->getTableyByIdentify($identify);

        return new TableResource($table);
    }
}
