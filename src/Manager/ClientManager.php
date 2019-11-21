<?php


namespace App\Manager;

use App\Entity\ClientEntity;
use App\Mapper\ClientMapper;
use App\Repository\ClapEntityRepository;
use App\Repository\ClientEntityRepository;
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

    public function register(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $client = new ClientEntity($data['email']);
        $Mapper = new ClientMapper();
        $Mapper->ClientData($data,$client,$this->encoder);
        $this->entityManager->persist($client);
        $this->entityManager->flush();
        return $client;
    }
    public function update(Request $request)
    {
        $client = json_decode($request->getContent(),true);
        $clientEntity=$this->clientRepository->find($request->get('id'));
        if (!$clientEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("client");
        }
        else {
            $clientMapper = new ClientMapper();
            $clientMapper->ClientData($client,$clientEntity,$this->encoder);
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
    public function delete(Request $request)
    {
        $clientEntity=$this->clientRepository->findClient($request->get('id'));
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
