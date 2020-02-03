<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ArtistEntity;
use App\Entity\ClapEntity;
use App\Entity\EntityInteractionEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\PaintingEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\PaintingMapper;
use App\Repository\ArtistEntityRepository;
use App\Repository\PaintingEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreatePaintingRequest;
use App\Request\DeleteRequest;
use App\Request\getPaintingByRequest;
use App\Request\UpdateFeaturedPaintingsRequest;
use App\Request\UpdatePaintingRequest;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class PaintingManager
{
    private $entityManager;
    private $paintingRepository;
    private $artistRepository;
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                PaintingEntityRepository $paintingRepository,
                                ArtistEntityRepository $artistEntityRepository,AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->paintingRepository=$paintingRepository;
        $this->artistRepository=$artistEntityRepository;
        $this->autoMapping=$autoMapping;
    }

    public function create(CreatePaintingRequest $request)
    {
        $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
        $painting=$this->autoMapping->map(CreatePaintingRequest::class,PaintingEntity::class,$request);
        $painting->setCreateDate();
        $this->entityManager->persist($painting);
        $this->entityManager->flush();
        return $painting;
    }

    public function update(UpdatePaintingRequest $request)
    {
        $paintingEntity=$this->paintingRepository->getPainting($request->getId());
        if (!$paintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("painting");
        }
        else {
            $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
            $paintingEntity=$this->autoMapping->mapToObject(UpdatePaintingRequest::class,
                PaintingEntity::class,$request,$paintingEntity);
            $paintingEntity->setUpdateDate();
            $this->entityManager->flush();
            return $paintingEntity;
        }
    }

    public function delete(DeleteRequest $request)
    {
        $id=$request->getId();
        $paintingEntity=$this->paintingRepository->getPainting($id);
        if (!$paintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("painting");
        }
        else {
            $paintingEntity->setActive(false);
            $this->entityManager->flush();
            return $paintingEntity;
        }
    }
    public function getAll()
    {
        $data=$this->paintingRepository->getAll();

        return $data;
    }

    public function getPaintingById($id)
    {
        return $result = $this->paintingRepository->findOneById($id);
    }

    public function getBy(GetPaintingByRequest $request)
    {
         $result = $this->paintingRepository->getBy($request->getParm(),$request->getValue());
         return $result;
    }

    public function getAllFeaturedPaintings()
    {
        $data=$this->paintingRepository->getAllFeaturedPaintings();

        return $data;
    }

    public function updateFeaturedPaintings(UpdateFeaturedPaintingsRequest $request)
    {
        $paintingEntity = $this->paintingRepository->getPainting($request->getId());

        if (!$paintingEntity)
        {
            $exception=new EntityException();
            $exception->entityNotFound("painting");
        }
        else
        {
            $paintingEntity=$this->autoMapping->mapToObject(UpdateFeaturedPaintingsRequest::class,
                PaintingEntity::class,$request,$paintingEntity);

            $paintingEntity->setUpdateDate();
            $this->entityManager->flush();

            return $paintingEntity;
        }
    }

}
