<?php


namespace App\Manager;


use App\Controller\Artist;
use App\Entity\ArtistEntity;
use App\Mapper\ArtistMapper;
use App\Mapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class ArtistManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $artist = json_decode($request->getContent(),true);
        $artistEntity=new ArtistEntity();
        $artistMapper = new ArtistMapper();
        $artistData=$artistMapper->artistData($artist, $artistEntity);
        $this->entityManager->persist($artistData);
        $this->entityManager->flush();
        return $artistData;
    }
    public function update(Request $request)
    {
        $artist = json_decode($request->getContent(),true);
        $artistEntity=$this->entityManager->getRepository(ArtistEntity::class)->getArtist($request->get('id'));
        if (!$artistEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("artist");
        }
        else {
            $artistMapper = new ArtistMapper();
            $artistMapper->ArtistData($artist, $artistEntity);
            $this->entityManager->flush();
            return $artistEntity;
        }
    }
    public function getAll()
    {
        $data=$this->entityManager->getRepository(ArtistEntity::class)->getAll();

        return $data;
    }

    public function getArtistById($request)
    {
        return $result = $this->entityManager->getRepository(ArtistEntity::class)->findById($request);
    }
    public function search(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->entityManager->getRepository(ArtistEntity::class)->search($data['keyword']);
    }
    public function getAllDetails()
    {
        $data=$this->entityManager->getRepository(ArtistEntity::class)->getAllDetails();

        return $data;
    }
}
