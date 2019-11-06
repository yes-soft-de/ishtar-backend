<?php


namespace App\Manager;

use App\Entity\EntityArtTypeEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Mapper\AutoMapper;
use App\Mapper\EntityArtTypeMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EntityArtTypeManager
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request,$entity,$entityID)
    {
        $entityArtType = json_decode($request->getContent(),true);
        $entityArtTypeEntity=new EntityArtTypeEntity();
        $entityArtTypeMapper = new EntityArtTypeMapper();
        $entityArtTypeData=$entityArtTypeMapper->EntityArtTypeData($entityArtType, $entityArtTypeEntity,$this->entityManager,$entity,$entityID);
        $this->entityManager->persist($entityArtTypeData);
        $this->entityManager->flush();
        return $entityArtTypeEntity;
    }
    public function update(Request $request,$entity)
    {
        $entityArtType = json_decode($request->getContent(),true);
        $entityArtTypeEntity=$this->entityManager->getRepository(EntityArtTypeEntity::class)->
        findEntity($request->get('id'),$entity);
        if (!$entityArtTypeEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("EntityArtType");
        }
        else {
            $artType=$this->entityManager->getRepository(ArtTypeEntity::class)->
            find($entityArtType['artType']);
            $entityArtTypeEntity->setArtType($artType);
            $this->entityManager->flush();
            return $entityArtTypeEntity;
        }
    }
    public function delete(Request $request,$entity)
    {
        if(!isset($entity))
            $entity=$request->get('entity');
        $arttype=$this->entityManager->getRepository(EntityArtTypeEntity::class)
            ->findEntity($request->get('id'),$entity);
        if (!$arttype) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $this->entityManager->remove($arttype);
            $this->entityManager->flush();
        }
    }
}
