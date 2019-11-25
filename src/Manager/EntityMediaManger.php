<?php


namespace App\Manager;

use App\Entity\Entity;
use App\Entity\EntityMediaEntity;
use App\Mapper\EntityMediaMapper;
use App\Repository\EntityMediaEntityRepository;
use App\Repository\EntityRepository;
use App\Repository\MediaEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateMediaRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateMediaRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;

class EntityMediaManger
{
    private $entityManager;
    private $entityMediaRepository;
    private $entityRepository;
    private $mediaRepository;
    public function __construct(EntityManagerInterface $entityManagerInterface,MediaEntityRepository $mediaRepository,
                                EntityMediaEntityRepository $entityMediaRepository,EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityMediaRepository=$entityMediaRepository;
        $this->entityRepository=$entityRepository;
        $this->mediaRepository=$mediaRepository;
    }
    public function create($request,$entity,$id)
    {
        $entityMediaEntity=new EntityMediaEntity();
        If(!isset($entity)&&!isset($id))
        {
            $config = new AutoMapperConfig();
            $config->registerMapping(CreateMediaRequest::class,
                EntityMediaEntity::class);
            $mapper = new AutoMapper($config);
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $request->setMedia($this->mediaRepository->find(1));
            $entityMediaEntity=$mapper->mapToObject($request,$entityMediaEntity);
        }
        else {
            $entityMediaEntity->setPath($request->getImage())
            ->setRow($id)
            ->setEntity($this->entityRepository->find($entity))
            ->setMedia($this->mediaRepository->find(1));
                if(!$entity==5)
            $entityMediaEntity->setName($request->getName());


        }
        $entityMediaEntity->setCreatedDate();
        $this->entityManager->persist($entityMediaEntity);
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
    public function getEntityItems(ByIdRequest $request)
    {
        return $this->entityRepository->getEntityItems($request->getId());
    }
    public function updateMediaById(UpdateMediaRequest $request)
    {
        $entityMediaEntity=$this->entityMediaRepository->find($request->getId());
        if (!$entityMediaEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else {
            $entityMediaEntity->setPath($request->getPath())
                ->setName($request->getName());
            $this->entityManager->flush();
            return $entityMediaEntity;
        }
    }
    public function deleteById(DeleteRequest $request)
    {
        $entityMediaEntity=$this->entityMediaRepository->find($request->getId());
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
