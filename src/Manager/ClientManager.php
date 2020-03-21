<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ClientEntity;
use App\Mapper\ClientMapper;
use App\Repository\ClapEntityRepository;
use App\Repository\ClientEntityRepository;
use App\Request\ByIdRequest;
use App\Request\DeleteRequest;
use App\Request\RegisterRequest;
use App\Request\UpdateClientLanguageRequest;
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
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $encoder
    ,ClientEntityRepository $clientRepository,AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->encoder=$encoder;
        $this->clientRepository=$clientRepository;
        $this->autoMapping=$autoMapping;
    }

    public function register(RegisterRequest $request)
    {
        $client = new ClientEntity($request->getEmail());
        $client=$this->autoMapping->mapToObject(RegisterRequest::class,ClientEntity::class,$request,$client);
        $client->setPassword($this->encoder->encodePassword($client,$request->getPassword()));
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
            $client=$this->autoMapping->mapToObject(RegisterRequest::class,ClientEntity::class,$request,
                $clientEntity);
            $client->setCreateDate();
            $client->setPassword($this->encoder->encodePassword($client,$request->getPassword()));
            $this->entityManager->flush();
            return $clientEntity;
        }
    }
    public function getAll()
    {
      return $this->clientRepository->findAll();
    }
    public function getById(ByIdRequest $request)
    {
        return $this->clientRepository->findClient($request->getId());
    }
    public function delete(DeleteRequest $request)
    {
        $clientEntity=$this->clientRepository->find($request->getId());
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

    public function UpdateClientLanguage(UpdateClientLanguageRequest $request)
    {
        $clientEntity = $this->clientRepository->find($request->getId());

        if (!$clientEntity)
        {
            $exception=new EntityException();
            $exception->entityNotFound("client");
        }
        else
        {
            $client = $this->autoMapping->mapToObject(UpdateClientLanguageRequest::class,ClientEntity::class,$request,
                $clientEntity);
            $client->setCreateDate();

            $this->entityManager->flush();

            return $clientEntity;
        }
    }
}
