<?php


namespace App\Manager;

use App\Entity\EntityArtTypeEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Mapper\AutoMapper;
use App\Mapper\EntityArtTypeMapper;
use App\Repository\ArtTypeRepository;
use App\Repository\EntityArtTypeEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EntityArtTypeManager
{
    private $entityManager;
    private $entityArtTypeRepository;
    private $artTypeRepository;
    public function __construct(EntityManagerInterface $entityManagerInterface,
                                EntityArtTypeEntityRepository $artTypeEntityRepository,ArtTypeRepository $artTypeRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityArtTypeRepository=$artTypeEntityRepository;
        $this->artTypeRepository=$artTypeRepository;
    }

    public function create($request,$entity,$entityID)
    {
       // $entityArtType = json_decode($request->getContent(),true);
        $entityArtTypeEntity=new EntityArtTypeEntity();
        $entityArtTypeMapper = new EntityArtTypeMapper();
        $entityArtTypeData=$entityArtTypeMapper->EntityArtTypeData($request->getArtType(), $entityArtTypeEntity,
            $this->entityManager,$entity,$entityID);
        $this->entityManager->persist($entityArtTypeData);
        $this->entityManager->flush();
        return $entityArtTypeEntity;
    }
    public function update($request,$entity)
    {
        $entityArtType = (array)$request;
        $entityArtTypeEntity=$this->entityArtTypeRepository->findEntity($entityArtType['id'],$entity);
        if (!$entityArtTypeEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("EntityArtType");
        }
        else {
            $artType=$this->artTypeRepository->find($entityArtType['artType']);
            $entityArtTypeEntity->setArtType($artType);
            $this->entityManager->flush();
            return $entityArtTypeEntity;
        }
    }
    public function delete($request,$entity)
    {
        if(!isset($entity))
            $entity=$request->getEntity();
        $arttype=$this->entityArtTypeRepository->findEntity($request->getId(),$entity);
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
