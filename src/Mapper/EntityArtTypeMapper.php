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
    public function EntityArtTypeData($data, EntityArtTypeEntity $artTypeEntity,$entityManger,$entity,$ID)
    {
        $artType = $entityManger->getRepository(ArtTypeEntity::class)->find($data['artType']);

        $entity = $entityManger->getRepository(\App\Entity\Entity::class)->find($entity);

        $artTypeEntity->setArtType($artType)
            ->setRow($ID)
            ->setEntity($entity)
            ->setArtType($artType);

        return $artTypeEntity;
    }
}