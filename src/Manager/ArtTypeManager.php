<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\ArtTypeEntity;
use App\Repository\ArtTypeRepository;
use App\Request\ByIdRequest;
use App\Request\CreateArtTypeRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateArtTypeRequest;
use Doctrine\ORM\EntityManagerInterface;

class ArtTypeManager
{
    private $entityManager;
    private $artTypeRepository;
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface,ArtTypeRepository $artTypeRepository
    ,AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->artTypeRepository=$artTypeRepository;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $artTypeData=$this->autoMapping->map(CreateArtTypeRequest::class,ArtTypeEntity::class,$request);
        $this->entityManager->persist($artTypeData);
        $this->entityManager->flush();
        return $artTypeData;
    }
    public function update(UpdateArtTypeRequest $request)
    {
        $artTypeEntity=$this->artTypeRepository->getArtType($request->getId());
        if (!$artTypeEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
        $artTypeEntity=$this->autoMapping->mapToObject(UpdateArtTypeRequest::class,ArtTypeEntity::class
            ,$request,$artTypeEntity);
            $this->entityManager->flush();
            return $artTypeEntity;
        }
    }
    public function delete(DeleteRequest $request)
    {
        $artType=$this->artTypeRepository->getArtType($request->getId());
        if (!$artType) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
        $this->entityManager->remove($artType);
        $this->entityManager->flush();
        return $artType;}
    }
    public function getAll()
    {
        $data=$this->artTypeRepository->findAll();

        return $data;
    }

    public function getArtTypeById(ByIdRequest $request)
    {
        return $result = $this->artTypeRepository->getById($request->getId());
    }

}
