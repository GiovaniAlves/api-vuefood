<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 *
 */
class ClientService
{
    /*** @var ClientRepositoryInterface */
    protected $clientRepository;

    /**
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewClient(array $data)
    {
        return $this->clientRepository->createNewClient($data);
    }
}
