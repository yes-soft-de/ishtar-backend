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
        $entity  =$entityManger->getRepository(Entity::class)->find($data["entity"]);
        $row = $data["row"];
        $body = $data["body"];
        $client = $entityManger->getRepository(ClientEntity::class)->find($data["client"]);

        $commentEntity->setEntity($entity)
            ->setRow($row)
            ->setBody($body)
            ->setDate()
            ->setClient($client)
            ->setSpacial(0);

        return $commentEntity;
    }
}