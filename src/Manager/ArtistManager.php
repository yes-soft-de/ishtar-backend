<?php


namespace App\Manager;


use App\Controller\Artist;
use App\Entity\ArtistEntity;
use App\Mapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ArtistManager
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create($artist)
    {
        $artistEntity=new ArtistEntity();
        $mapper=new AutoMapper();

            $data = $mapper->Map($artist, $artistEntity);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        return $data;

    }

}
