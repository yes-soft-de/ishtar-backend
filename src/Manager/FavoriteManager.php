<?php


namespace App\Manager;

use App\Entity\ArtistEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\FavoriteEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\FavoriteMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class FavoriteManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $favorite = json_decode($request->getContent(),true);
        $favoriteEntity=new FavoriteEntity();
        $favoriteMapper = new FavoriteMapper();
        $favoriteData=$favoriteMapper->FavoriteData($favorite, $favoriteEntity,$this->entityManager);
        $this->entityManager->persist($favoriteData);
        $this->entityManager->flush();
        return $favoriteData;
    }
    public function update(Request $request)
    {
        $favorite = json_decode($request->getContent(),true);
        $favoriteEntity=$this->entityManager->getRepository(FavoriteEntity::class)->getFavorite($request->get('id'));
        if (!$favoriteEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("favorite");
        }
        else {
            $favoriteMapper = new FavoriteMapper();
            $favoriteMapper->FavoriteData($favorite, $favoriteEntity,$this->entityManager);
            $this->entityManager->flush();
            return $favoriteEntity;
        }
    }
    public function delete(Request $request)
    {
        $favoriteEntity=$this->entityManager->getRepository(FavoriteEntity::class)
            ->getfavorite($request->get('id'));
        if (!$favoriteEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("favorite");
        }
        else {
            $favoriteEntity->setActive(0);
            $this->entityManager->flush();
            return $favoriteEntity;
        }
    }
    public function getAll()
    {
        $data=$this->entityManager->getRepository(FavoriteEntity::class)->getAll();

        return $data;
    }

    public function getFavoriteById($request)
    {
        return $result = $this->entityManager->getRepository(FavoriteEntity::class)->findOneById($request);
    }

}
