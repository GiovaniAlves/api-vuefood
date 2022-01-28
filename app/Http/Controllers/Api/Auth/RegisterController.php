<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreClientFormRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

/**
 *
 */
class RegisterController extends Controller
{
    /*** @var ClientService */
    protected $clientService;

    /**
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @param StoreClientFormRequest $request
     * @return ClientResource
     */
    public function store(StoreClientFormRequest $request)
    {
        $client = $this->clientService->createNewClient($request->all());

        return new ClientResource($client);
    }
}
