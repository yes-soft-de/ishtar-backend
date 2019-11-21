<?php


namespace App\Manager;

use App\Entity\ClientEntity;
use App\Mapper\ClientMapper;
use App\Repository\ClapEntityRepository;
use App\Repository\ClientEntityRepository;
use App\Request\DeleteRequest;
use App\Request\RegisterRequest;
use App\Request\UpdateClientRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientManager
{
    private $entityManager;
    private $encoder;
    private $clientRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $encoder
    ,ClientEntityRepository $clientRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->encoder=$encoder;
        $this->clientRepository=$clientRepository;

    }

    public function register(RegisterRequest $request)
    {
        $client = new ClientEntity($request->getEmail());
        $config = new AutoMapperConfig();
        $config->registerMapping(RegisterRequest::class, ClientEntity::class);
        $mapper = new AutoMapper($config);
        $client=$mapper->mapToObject($request,$client);
        $client->setCreateDate();
        $this->entityManager->persist($client);
        $this->entityManager->flush();
        return $client;
    }
    public function update(UpdateClientRequest $request)
    {
        $clientEntity=$this->clientRepository->find($request->getId());
        if (!$clientEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("client");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(RegisterRequest::class, ClientEntity::class);
            $mapper = new AutoMapper($config);
            $client=$mapper->mapToObject($request,$clientEntity);
            $client->setCreateDate();
            $this->entityManager->flush();
            return $clientEntity;
        }
    }
    public function getAll()
    {
      return $this->clientRepository->findAll();
    }
    public function getById($request)
    {
        return $this->clientRepository->findClient($request);
    }
    public function delete(DeleteRequest $request)
    {
        $clientEntity=$this->clientRepository->findClient($request->getId());
        if (!$clientEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("client");
        }
        else {
            $clientEntity->setIsActive(0);
            $this->entityManager->flush();
            return $clientEntity;
        }
    }
}
