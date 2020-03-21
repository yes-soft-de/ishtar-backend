<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\Entity;
use App\Entity\EntityMediaEntity;
use App\Mapper\EntityMediaMapper;
use App\Repository\EntityMediaEntityRepository;
use App\Repository\EntityRepository;
use App\Repository\MediaEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateMediaRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateMediaImageLinkRequest;
use App\Request\UpdateMediaRequest;
use App\Request\UpdateMediaThumbImageRequest;
use Doctrine\ORM\EntityManagerInterface;

class EntityMediaManger
{
    private $entityManager;
    private $entityMediaRepository;
    private $entityRepository;
    private $mediaRepository;
    private $autoMapping;
    public function __construct(EntityManagerInterface $entityManagerInterface,MediaEntityRepository $mediaRepository,
                                EntityMediaEntityRepository $entityMediaRepository,EntityRepository $entityRepository,
                                AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityMediaRepository=$entityMediaRepository;
        $this->entityRepository=$entityRepository;
        $this->mediaRepository=$mediaRepository;
        $this->autoMapping=$autoMapping;
    }
    public function create($request,$entity,$id)
    {
        //dd($request->getThumbImage());
        $entityMediaEntity=new EntityMediaEntity();
        If(!isset($entity)&&!isset($id))
        {
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $request->setMedia($this->mediaRepository->find(1));
            $entityMediaEntity=$this->autoMapping->mapToObject(CreateMediaRequest::class,
                EntityMediaEntity::class,$request,$entityMediaEntity);
        }
        else
        {
            $entityMediaEntity->setPath($request->getImage())
                ->setRow($id)
                ->setEntity($this->entityRepository->find($entity))
                ->setMedia($this->mediaRepository->find(1));

            if(!$entity == 5)
            {
                $entityMediaEntity->setName($request->getName());
            }
        }

        //we need to check if there is thumbImage in request, for now just artist in this scenario has resolved image  13-2-2020
        //Todo asap: add another image for painting?!!
        if ($entity == 2)
        {
            $entityMediaEntity->setThumbImage($request->getThumbImage());
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

        return $media;
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
        $entityMediaEntity = $this->entityMediaRepository->find($request->getId());

        if (!$entityMediaEntity)
        {
            $exception = new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else
        {
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
        }
        return $entityMediaEntity;
    }

    public function updateMediaThumbImageById(UpdateMediaThumbImageRequest $request)
    {
        $entityMediaEntity = $this->entityMediaRepository->find($request->getId());

        if (!$entityMediaEntity)
        {
            $exception = new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else
        {
            $entityMediaEntity->setThumbImage($request->getThumbImage());
            $this->entityManager->flush();

            return $entityMediaEntity;
        }
    }

    public function updateMediaImageLink(UpdateMediaImageLinkRequest $request)
    {
        $entityMediaEntity = $this->entityMediaRepository->find($request->getId());

        if (!$entityMediaEntity)
        {
            $exception = new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else
        {
            $entityMediaEntity->setPath($request->getImage());
            $this->entityManager->flush();

            return $entityMediaEntity;
        }
    }
}
