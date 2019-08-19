<?php

namespace App\Mapper;

use App\Entity\ ClientEntity;
use DateTime;
use Exception;

class  ClientMapper
{
    public function clientData($data, ClientEntity $client)
    {
        $name     = $data["name"];
        $userName = $data["userName"];
        $password = $data["password"];
        $email    = $data["email"];

        $client->setName($name)
            ->setUserName($userName)
            ->setPassword($password)
            ->setEmail($email);
        return $client;
    }
}