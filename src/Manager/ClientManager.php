<?php


namespace App\Manager;

use App\Entity\ClientEntity;
use App\Mapper\ClientMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientManager
{
    private $entityManager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManagerInterface,UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManagerInterface;
        $this->encoder=$encoder;

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
        $clientEntity=$this->entityManager->getRepository(ClientEntity::class)->find($request->get('id'));
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
      return $this->entityManager->getRepository(ClientEntity::class)->findAll();
    }
    public function getById(Request $request)
    {
        return $this->entityManager->getRepository(ClientEntity::class)->findClient($request->get('id'));
    }
    public function delete(Request $request)
    {
        $clientEntity=$this->entityManager->getRepository(ClientEntity::class)->findClient($request->get('id'));
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
