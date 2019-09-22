<?php

namespace App\Mapper;

use App\Entity\ ClientEntity;
use DateTime;
use Exception;

class  ClientMapper
{
    public function clientData($data, ClientEntity $client)
    {
        $firstName     = $data["firstName"];
        $lastName     = $data["lastName"];
        $userName = $data["userName"];
        $password = $data["password"];
        $email    = $data["email"];
        $phone=$data['phone'];
        $roll=$data['roll'];
        switch ($roll) {
            case 'Artist':$roll = 1;
            break;
            case 'Famouse':$roll=2;
            break;
            case 'admin':$roll=3;
            break;
            case 'Client':$roll=4;
            break;
            default :$roll=4;
        }
        try {
            $birthDate = new DateTime((string)$data["birthDate"]);
        } catch (Exception $e) {
        }


        $client->setfirstName($firstName)
            ->setUserName($userName)
            ->setPassword($password)
            ->setEmail($email)
             ->setBirthDate($birthDate)
            ->setLastName($lastName)
            ->setRoll($roll)
            ->setPhone($phone);
        return $client;
    }
}