<?php


namespace App\Manager;

use App\Entity\Entity;
use App\Entity\EntityMediaEntity;
use App\Mapper\EntityMediaMapper;
use App\Repository\EntityMediaEntityRepository;
use App\Repository\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityMediaManger
{
    private $entityManager;
    private $entityMediaRepository;
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                EntityMediaEntityRepository $entityMediaRepository,EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityMediaRepository=$entityMediaRepository;
        $this->entityRepository=$entityRepository;
    }
    public function create($request,$entity,$id)
    {
       $entityMedia= (array)$request;
        $entityMediaEntity=new EntityMediaEntity();
        $entityMediaMapper = new entityMediaMapper();
        $entityMediaData=$entityMediaMapper->MediaEntityData($entityMedia, $entityMediaEntity,$this->entityManager,$entity,$id);
        $entityMediaEntity->setCreatedDate();
        $this->entityManager->persist($entityMediaData);
        $this->entityManager->flush();
        return $entityMediaEntity;
    }
    public function update($request,$entity)
    {
        $entityMedia = (array)$request;
        $entityMediaEntity=$this->entityMediaRepository->findImages($entityMedia['id'],$entity);
        if (!$entityMediaEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else {
           $entityMediaEntity->setPath($entityMedia['image']);
           $entityMediaEntity->setUpdateDate();
            $this->entityManager->flush();
            return $entityMediaEntity;
        }
    }
    public function delete($request,$entity)
    {
        if(!isset($entity))
            $entity=$request->getEntity();
        $media=$this->entityMediaRepository->findImages($request->getId(),$entity);
        if (!$media) {
            $exception=new EntityException();
            $exception->entityNotFound("media");
        }
        else {
            $this->entityManager->remove($media);
            $this->entityManager->flush();
        }
    }
    public function getAll()
    {
        $data=$this->entityMediaRepository->findAll();


        return $data;
    }
    public function getEntityItems(Request $request)
    {
        return $this->entityRepository->getEntityItems($request->get('entity'));
    }
    public function updateMediaById(Request $request)
    {
        $entityMediaEntity=$this->entityMediaRepository->find($request->get('id'));
        if (!$entityMediaEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else {
            $entityMedia = json_decode($request->getContent(),true);
            $entityMediaEntity->setPath($entityMedia['image']);
            $this->entityManager->flush();
            return $entityMediaEntity;
        }
    }
    public function deleteById(Request $request)
    {
        $entityMediaEntity=$this->entityMediaRepository->find($request->get('id'));
        if (!$entityMediaEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else {
            $this->entityManager->remove($entityMediaEntity);
            $this->entityManager->flush();
            return $entityMediaEntity;
        }
    }

}
