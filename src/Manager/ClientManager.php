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
}
