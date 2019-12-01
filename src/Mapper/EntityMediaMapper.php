<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\ClientEntity;
use App\Entity\Entity;
use App\Entity\EntityMediaEntity;
use App\Entity\MediaEntity;
use App\Entity\PaintingEntity;
use DateTime;
use Exception;

class EntityMediaMapper{
    private $en;
    public function MediaEntityData($data, EntityMediaEntity $mediaEntity,$entityManger,$entity,$ID)
    {

            $path = $data['image'];
            if(!isset($data['name']))
                $name=$path;
            else
            $name = $data['name'];
            $media = $entityManger->getRepository(MediaEntity::class)->find(1);
            $entity = $entityManger->getRepository(Entity::class)->find($entity);
            if(isset($data['row']))
                $ID=$data['row'];

        $mediaEntity->setEntity($entity)
            ->setMedia($media)
            ->setRow($ID)
            ->setPath($path)
            ->setName($name)
        ;

        return $mediaEntity;
    }

}