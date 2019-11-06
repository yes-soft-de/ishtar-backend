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
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class PaintingManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $painting = json_decode($request->getContent(),true);
        $paintingEntity=new PaintingEntity();
        $paintingMapper = new PaintingMapper();
        $paintingData=$paintingMapper->PaintingData($painting, $paintingEntity,$this->entityManager);
        $this->entityManager->persist($paintingData);
        $this->entityManager->flush();
        return $paintingData;
    }
    public function update(Request $request)
    {
        $painting = json_decode($request->getContent(),true);
        $paintingEntity=$this->entityManager->getRepository(PaintingEntity::class)->getPainting($request->get('id'));
        if (!$paintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("painting");
        }
        else {
            $paintingMapper = new PaintingMapper();
            $paintingMapper->PaintingData($painting, $paintingEntity,$this->entityManager);
            $this->entityManager->flush();
            return $paintingEntity;
        }
    }
    public function delete(Request $request)
    {
        $id=$request->get('id');
        $paintingEntity=$this->entityManager->getRepository(PaintingEntity::class)->getPainting($id);
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
        $data=$this->entityManager->getRepository(PaintingEntity::class)->getAll();

        return $data;
    }
    public function getArtistPaintings(Request $request)
    {
        $data = json_decode($request->getContent(),true);
         $result = $this->entityManager->getRepository(ArtistEntity::class)->getArtistPaintings($data['id']);
    return $result;
    }

    public function getPaintingById($id)
    {
        return $result = $this->entityManager->getRepository(PaintingEntity::class)->findOneById($id);
    }

    public function getPaintingImages(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->entityManager->getRepository(EntityMediaEntity::class)->getPaintingImages($data['id']);
    }
    public function getBy(Request $request)
    {
         $result = $this->entityManager->getRepository(PaintingEntity::class)->
        getBy($request->get('parm'),$request->get('value'));
         return $result;
    }

}
