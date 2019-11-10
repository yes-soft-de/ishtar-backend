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
        if (isset($data['username']))
            $client->setUserName($data['username']);
        if (isset($data['birthDate']))
            try {
                $client->setBirthDate(new DateTime((string)$data["birthDate"]));
            } catch (Exception $e) {
            }
        if (isset($data['phone']))
            $client->setPhone($data['phone']);
        if (isset($data['fullName']))
            $client->setFullName($data['fullName']);
        $client->setPassword($encoder->encodePassword($client, $password));
        $client->setRoles(["ROLE_USER"]);
        $client->setEmail($email);
        $client->setUpdateDate(new DateTime('Now'));
        return $client;
    }
}