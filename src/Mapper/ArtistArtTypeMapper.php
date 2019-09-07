<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\EntityArtTypeEntity;

class ArtistArtTypeMapper
{
    private $en;
    public function ArtistArtTypeData($data, EntityArtTypeEntity $artTypeEntity,$entityManger)
    {
        $this->en=$entityManger;
        $entity = $this->en->getRepository(\App\Entity\Entity::class)->find(2);
        $artType = $this->en->getRepository(ArtTypeEntity::class)->find($data['artType']);

            $row = $this->en->getRepository(ArtistEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            $row= $row[0]->getId()+1;


        $artTypeEntity->setArtType($artType)
            ->setRow($row)
            ->setEntity($entity)
            ->setArtType($artType);

        return $artTypeEntity;
    }
}