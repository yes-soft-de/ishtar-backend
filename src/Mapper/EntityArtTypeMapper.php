<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\ArtType;
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
    private $en;
    public function EntityArtTypeData($data, EntityArtTypeEntity $artTypeEntity,$entityManger)
    {
        $this->en=$entityManger;
        $entity = $this->en->getRepository(\App\Entity\Entity::class)->find(1);
        $artType = $this->en->getRepository(ArtTypeEntity::class)->find($data['artType']);
    $row=$this->en->getRepository(PaintingEntity::class)->findBy(array(),array('id'=>'DESC'),1,1);

$id= $row[0]->getId()+1;
        $artTypeEntity->setArtType($artType)
            ->setRow($id)
            ->setEntity($entity)
            ->setArtType($artType);

        return $artTypeEntity;
    }
}