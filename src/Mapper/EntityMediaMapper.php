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
    public function MediaEntityData($data, EntityMediaEntity $mediaEntity,$entityManger,$entityId)
    {
        $this->en=$entityManger;
        if($entityId==2)
        {$entity = $this->en->getRepository(Entity::class)->find(2);
        $media=$this->en->getRepository(MediaEntity::class)->find(1);
        $row = $this->en->getRepository(ArtistEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            if(!isset($row[0]))
                $row=1;
            else
                $row= $row[0]->getId()+1;
        $path=$data['image'];
        $name=$data['image'];
        }

        else if ($entityId==5) {
            $entity = $this->en->getRepository(Entity::class)->find(5);
            $media = $this->en->getRepository(MediaEntity::class)->find(1);
            $row = $this->en->getRepository(ClientEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            $row = $this->en->getRepository(ArtistEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            if(!isset($row[0]))
                $row=1;
            else
                $row= $row[0]->getId()+1;
            $path = $data['image'];
            $name = $data['image'];
        }
        else if ($entityId==3) {
            $entity = $this->en->getRepository(Entity::class)->find(3);
            $media = $this->en->getRepository(MediaEntity::class)->find(1);
            $row = $this->en->getRepository(ArtTypeEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
            if(!isset($row[0]))
                $row=1;
            else
                $row= $row[0]->getId()+1;
            $path = $data['image'];
            $name = $data['image'];
        }
        else  {
            $entity = $this->en->getRepository(Entity::class)->find($data['entity']);
            $media = $this->en->getRepository(MediaEntity::class)->find($data['media']);
            $row = $data['row'];
            $path = $data['path'];
            $name = $data['name'];
        }

        $mediaEntity->setEntity($entity)
            ->setMedia($media)
            ->setRow($row)
            ->setPath($path)
            ->setName($name);

        return $mediaEntity;
    }

}