<?php

namespace App\Mapper;

use App\Entity\ClientEntity;
use App\Entity\CommentEntity;
use App\Entity\Entity;
use DateTime;
use Exception;

class CommentMapper
{
    private $en;
    public function commentData($data, CommentEntity $commentEntity,$entityManger)
    {
        $this->en=$entityManger;
        $entity  = $this->en->getRepository(Entity::class)->find($data["entity"]);
        $row = $data["row"];
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $date = new DateTime((string)$data["date"]);
        } catch (Exception $e) {
        }

        $lastEdit=$data["lastEdit"];
        try {
            $lastEdit = new DateTime((string)$data["lastEdit"]);
        } catch (Exception $e) {
        }
        $body = $data["body"];
        $client = $this->en->getRepository(ClientEntity::class)->find($data["client"]);
        $spacial=$data['spacial'];

        $commentEntity->setEntity($entity)
            ->setRow($row)
            ->setBody($body)
            ->setDate($date)
            ->setLastEdit($lastEdit)
            ->setClient($client)
            ->setSpacial($spacial);

        return $commentEntity;
    }
}