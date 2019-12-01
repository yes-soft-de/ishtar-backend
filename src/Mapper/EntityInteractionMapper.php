<?php

namespace App\Mapper;

use App\Entity\ClientEntity;
use App\Entity\Entity;
use App\Entity\EntityInteractionEntity;
use App\Entity\InteractionEntity;

class EntityInteractionMapper

{
    private $en;
    public function EntityInteractionData($data,EntityInteractionEntity $interactionEntity,$entityManager)
    {
        $this->en=$entityManager;
        $entity = $this->en->getRepository(Entity::class)->find($data["entity"]);
        $row = $data["row"];
        $interaction   = $this->en->getRepository(InteractionEntity::class)->find($data["interaction"]);
        $client = $this->en->getRepository(ClientEntity::class)->findOneById($data["client"]);

        $interactionEntity->setClient($client)
            ->setRow($row)
            ->setEntity($entity)
            ->setInteraction($interaction)
            ->setDate();
        return $interactionEntity;
    }
}