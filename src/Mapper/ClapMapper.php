<?php

namespace App\Mapper;

use App\Entity\ClapEntity;
use App\Entity\ClientEntity;
use App\Entity\Entity;

class ClapMapper
{
    private $en;
    public function clapData($data, ClapEntity $clapEntity,$entityManger)
    {
        $this->en=$entityManger;
        $entity  = $this->en->getRepository(Entity::class)->find($data["entity"]);
        $row = $data["row"];
        $value   = $data["value"];
        $client = $this->en->getRepository(ClientEntity::class)->find($data["client"]);

        $clapEntity->setEntity($entity)
            ->setRow($row)
            ->setValue($value)
            ->setClient($client);

        return $clapEntity;
    }
}