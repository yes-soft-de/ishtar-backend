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

class ArtistManager
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
        $artistEntity=new ArtistEntity();
        $artistData = $this->autoMapper->Map($artist, $artistEntity);
        $this->entityManager->persist($artistData);
        $this->entityManager->flush();
        return $artistEntity;
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
