<?php


namespace App\Manager;

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
use App\Request\CreatePaintingRequest;
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

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                PaintingEntityRepository $paintingRepository,ArtistEntityRepository $artistEntityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->paintingRepository=$paintingRepository;
        $this->artistRepository=$artistEntityRepository;
    }

    public function create(CreatePaintingRequest $request)
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreatePaintingRequest::class, PaintingEntity::class);
        $mapper = new \AutoMapperPlus\AutoMapper($config);
        $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
        $paintingData=$mapper->map($request,PaintingEntity::class);
        $paintingData->setCreateDate();
        $this->entityManager->persist($paintingData);
        $this->entityManager->flush();
        return $paintingData;
    }
    public function update($request)
    {
        $paintingEntity=$this->paintingRepository->getPainting($request->getId());
        if (!$paintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("painting");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(UpdatePaintingRequest::class, PaintingEntity::class);
            $mapper = new \AutoMapperPlus\AutoMapper($config);
            $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
            $paintingEntity=$mapper->mapToObject($request,$paintingEntity);
            $paintingEntity->setUpdateDate();
            $this->entityManager->flush();
            return $paintingEntity;
        }
    }
    public function delete(Request $request)
    {
        $id=$request->get('id');
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
    public function getArtistPaintings(Request $request)
    {
        $data = json_decode($request->getContent(),true);
         $result = $this->paintingRepository->getArtistPaintings($data['id']);
    return $result;
    }

    public function getPaintingById($id)
    {
        return $result = $this->paintingRepository->findOneById($id);
    }

    public function getPaintingImages(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->paintingRepository->getPaintingImages($data['id']);
    }
    public function getBy(Request $request)
    {
         $result = $this->paintingRepository->getBy($request->get('parm'),$request->get('value'));
         return $result;
    }

}
