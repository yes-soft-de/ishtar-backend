<?php

namespace App\Mapper;

use App\Entity\ArtTypeEntity;
use App\Entity\ClientEntity;
use App\Entity\InteractionEntity;
use App\Repository\ClientEntityRepository;
use App\Repository\InteractionEntityRepository;

class InteractionMapper

{
private $en;
    public function interactionData($data,InteractionEntity $interaction,$entityManager)
    {
        $this->en=$entityManager;
        $pageName = $data["pageName"];
        $rowNum = $data["rowNum"];
        $interactionType   = $data["interactionType"];
        $client = $this->en->getRepository(ClientEntity::class)->findOneById($data["client"]);

        $interaction->setPageName($pageName)
            ->setRowNum($rowNum)
            ->setInteractionType($interactionType)
            ->setClient($client);
        return $interaction;
    }
}