<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\EntityArtTypeEntity;
use App\Entity\GalleryEntity;
use App\Entity\PaintingEntity;
use App\Entity\PriceEntity;
use App\Repository\GalleryEntityRepository;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use phpDocumentor\Reflection\Types\This;

class EntityArtTypeMapper
{
    public function EntityArtTypeData($data, EntityArtTypeEntity $artTypeEntity,$entityManger,$entity)
    {
        $artType = $entityManger->getRepository(ArtTypeEntity::class)->find($data['artType']);
        if($entity==1) {
            $row = $entityManger->getRepository(PaintingEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            if (!isset($row[0]))
                $row = 1;
            else
                $row = $row[0]->getId() + 1;
        }
        else if($entity==2)
        {
            $row = $entityManger->getRepository(ArtistEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            if (!isset($row[0]))
                $row = 1;
            else
                $row = $row[0]->getId() + 1;
        }
        $entity = $entityManger->getRepository(\App\Entity\Entity::class)->find($entity);

        $artTypeEntity->setArtType($artType)
            ->setRow($row)
            ->setEntity($entity)
            ->setArtType($artType);

        return $artTypeEntity;
    }
}