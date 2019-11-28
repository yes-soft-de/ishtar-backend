<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\EntityArtTypeEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Mapper\AutoMapper;
use App\Mapper\EntityArtTypeMapper;
use App\Repository\ArtTypeRepository;
use App\Repository\EntityArtTypeEntityRepository;
use App\Repository\EntityRepository;
use App\Request\CreateArtTypeRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EntityArtTypeManager
{
    private $entityManager;
    private $entityArtTypeRepository;
    private $artTypeRepository;
    private $autoMapping;
    private $entityRepository;
    public function __construct(EntityManagerInterface $entityManagerInterface,
                                EntityArtTypeEntityRepository $artTypeEntityRepository,
                                ArtTypeRepository $artTypeRepository,AutoMapping $autoMapping,
                                EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityArtTypeRepository=$artTypeEntityRepository;
        $this->artTypeRepository=$artTypeRepository;
        $this->autoMapping=$autoMapping;
        $this->entityRepository=$entityRepository;
    }

    public function create($request,$entity,$entityID)
    {
        $entityArtTypeEntity=new EntityArtTypeEntity();
        $entityArtTypeEntity->setArtType($this->artTypeRepository->getArtType($request->getArtType()))
            ->setEntity($this->entityRepository->find($entity));
           $entityArtTypeEntity->setRow($entityID);
        $this->entityManager->persist($entityArtTypeEntity);
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
