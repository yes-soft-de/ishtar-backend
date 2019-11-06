<?php

namespace App\Mapper;

use App\Entity\ ClientEntity;
use DateTime;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class  ClientMapper
{
    public function clientData($data, ClientEntity $client,$encoder)
    {
        $email = $data['email'];
        $password = $data['password'];
        $client->setPassword($encoder->encodePassword($client, $password));
        $client->setRoles(["ROLE_USER"]);
        $client->setEmail($email);
        return $client;
    }
}