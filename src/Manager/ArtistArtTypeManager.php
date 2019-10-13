<?php


namespace App\Manager;

use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Exception\EntityException;
use App\Mapper\AutoMapper;
use App\Request\CreateArtistRequest;
use App\Request\UpdateArtistRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ArtistArtTypeManager
{
    private $entityManager;
    private $autoMapper;


    public function __construct(EntityManagerInterface $entityManagerInterface,AutoMapper $autoMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->autoMapper=$autoMapper;
    }

    public function create(CreateArtistRequest $artist)
    {
        $artTypeEntity=new EntityArtTypeEntity();
        $artist->setEntity($this->entityManager->getRepository(Entity::class)->find(2));
        $artist->setArtType($this->entityManager->getRepository(ArtTypeEntity::class)->find($artist->getArtType()));
        $row=$this->entityManager->getRepository(ArtistEntity::class)->
        findBy(array(), array('id' => 'DESC'), 1, 1);
        if(!isset($row[0]))
            $row=1;
        else
            $row= $row[0]->getId()+1;
        $artist->setRow($row);
        $artTypeData=$this->autoMapper->Map($artist,$artTypeEntity);
        $this->entityManager->persist($artTypeData);
        $this->entityManager->flush();
        return $artTypeEntity;
    }
    public function update(UpdateArtistRequest $artist)
    {
        $artistEntity=$this->entityManager->getRepository(ArtistEntity::class)->find($artist->getId());

        if (!$artistEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("artist");
        }
        else {
            $data = $this->autoMapper->Map($artist, $artistEntity);
            $this->entityManager->flush();
            return $artistEntity;
        }
    }

}
