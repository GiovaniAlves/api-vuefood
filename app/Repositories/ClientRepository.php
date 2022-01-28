<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 *
 */
class ClientRepository implements ClientRepositoryInterface
{
    /*** @var Client */
    protected $entity;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->entity = $client;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewClient(array $data)
    {
        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {
        // TODO: Implement getClient() method.
    }
}
