<?php


namespace App\Service;

use App\Manager\ClientManager;
use App\Manager\EntityMediaManger;

class ClientService implements ClientServiceInterface
{
    private $clientManager;
    private $mediaManager;

    public function __construct(ClientManager $clientManager,EntityMediaManger $mediaManager)
    {
        $this->clientManager=$clientManager;
        $this->mediaManager=$mediaManager;
    }

    public function register($request)
    {
        $result =$this->clientManager->register($request);
        $clientID=$result->getId();
        $this->mediaManager->create($request,5,$clientID);
      return $result;
    }

    public function login($request)
    {
        // TODO: Implement login() method.
    }

    public function update($request)
    {
        // TODO: Implement update() method.
        $this->mediaManager->update($request,5);
        return $this->clientManager->update($request);
    }

    public function getAll()
    {
        return $this->clientManager->getAll();
    }

    public function getById($requset)
    {
        return $this->clientManager->getById($requset);
    }

    public function delete($request)
    {
        return $this->clientManager->delete($request);
    }
}