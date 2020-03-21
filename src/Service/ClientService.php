<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\ClientEntity;
use App\Manager\ClientManager;
use App\Manager\EntityMediaManger;
use App\Request\RegisterRequest;
use App\Response\DeleteResponse;
use App\Response\GetClientsResponse;
use App\Response\RegisterResponse;
use App\Response\UpdateClientResponse;

class ClientService implements ClientServiceInterface
{
    private $clientManager;
    private $mediaManager;
    private $autoMapping;

    public function __construct(ClientManager $clientManager,EntityMediaManger $mediaManager,AutoMapping $autoMapping)
    {
        $this->clientManager=$clientManager;
        $this->mediaManager=$mediaManager;
        $this->autoMapping=$autoMapping;
    }

    public function register($request)
    {
        $result =$this->clientManager->register($request);
        $clientID=$result->getId();
        $this->mediaManager->create($request,5,$clientID);
        $response=$this->autoMapping->map(ClientEntity::class,RegisterResponse::class,$result);

        return $response;
    }

    public function login($request)
    {
        // TODO: Implement login() method.
    }

    public function update($request)
    {
        $mediaResult=$this->mediaManager->update($request,5);
        $result= $this->clientManager->update($request);
        $response=$this->autoMapping->map(ClientEntity::class,UpdateClientResponse::class,$result);
        $response->setImage($mediaResult->getPath());

    }

    public function getAll()
    {
        $result=$this->clientManager->getAll();
        foreach ($result as $row)
            $response[]=$this->autoMapping->map('array',GetClientsResponse::class,$row);
        return $response;
    }

    public function getById($requset)
    {
        $result=$this->clientManager->getById($requset);
        $response=$this->autoMapping->map('array',GetClientsResponse::class,$result);
        return $response;
    }

    public function delete($request)
    {
        $result=$this->clientManager->delete($request);
        $this->mediaManager->delete($request,5);
        $response=new DeleteResponse($result->getId());
        return $response;

    }

    public function UpdateClientLanguage($request)
    {
        $result = $this->clientManager->UpdateClientLanguage($request);
        $response = $this->autoMapping->map(ClientEntity::class,UpdateClientResponse::class,$result);

        return $response;
    }
}