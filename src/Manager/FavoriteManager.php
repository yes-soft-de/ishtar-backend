<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ArtistEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\FavoriteEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\FavoriteMapper;
use App\Repository\ClientEntityRepository;
use App\Repository\FavoriteEntityRepository;
use App\Repository\PaintingEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateFavoriteRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateFavoriteRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class FavoriteManager
{
    private $entityManager;
    private $favoriteRepository;
    private $clientRepository;
    private $paintingRepository;
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                FavoriteEntityRepository $favoriteRepository,AutoMapping $autoMapping,
        ClientEntityRepository $clientRepository,PaintingEntityRepository $paintingRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->favoriteRepository=$favoriteRepository;
        $this->autoMapping=$autoMapping;
        $this->clientRepository=$clientRepository;
        $this->paintingRepository=$paintingRepository;
    }

    public function create(CreateFavoriteRequest $request)
    {
        $request->setClient($this->clientRepository->find($request->getClient()));
        $request->setPainting($this->paintingRepository->getPainting($request->getPainting()));
        $favorite=$this->autoMapping->map(CreateFavoriteRequest::class,FavoriteEntity::class,$request);
        $this->entityManager->persist($favorite);
        $this->entityManager->flush();
        return $favorite;
    }
    public function update(UpdateFavoriteRequest $request)
    {
        $favoriteEntity=$this->favoriteRepository->getClientFavorite($request->getId());
        if (!$favoriteEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("favorite");
        }
        else {
            $favoriteEntity=$this->autoMapping->mapToObject(UpdateFavoriteRequest::class
            ,FavoriteEntity::class,$request,$favoriteEntity);
            $this->entityManager->flush();
            return $favoriteEntity;
        }
    }
    public function delete(DeleteRequest $request)
    {
        $favoriteEntity=$this->favoriteRepository->find($request->getId());
        if (!$favoriteEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("favorite");
        }
        else {
            $this->entityManager->remove($favoriteEntity);
            $this->entityManager->flush();
            return $favoriteEntity;
        }
    }
    public function getAll()
    {
        $data=$this->favoriteRepository->findAll();

        return $data;
    }

    public function getClientFavorite(ByIdRequest $request)
    {
        return $result = $this->favoriteRepository->getClientFavorite($request->getId());
    }

}
