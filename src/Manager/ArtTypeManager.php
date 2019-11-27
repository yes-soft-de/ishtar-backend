<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\ArtTypeEntity;
use App\Mapper\ArtTypeMapper;
use App\Repository\ArtTypeRepository;
use App\Request\CreateArtTypeRequest;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

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
        $artTypeEntity=new ArtTypeEntity();
        $artTypeData=$this->autoMapping->map(CreateArtTypeRequest::class,ArtTypeEntity::class,$request);
        $this->entityManager->persist($artTypeData);
        $this->entityManager->flush();
        return $artTypeData;
    }
    public function update(Request $request)
    {
        $artType = json_decode($request->getContent(),true);
        $artTypeEntity=$this->artTypeRepository->getArtType($request->get('id'));
        if (!$artTypeEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $artTypeMapper = new ArtTypeMapper();
            $artTypeMapper->artTypeData($artType, $artTypeEntity);
            $this->entityManager->flush();
            return $artTypeEntity;
        }
    }
    public function delete(Request $request)
    {
        $artType=$this->artTypeRepository->getArtType($request->get('id'));
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

    public function getArtTypeById(Request $request)
    {
        return $result = $this->artTypeRepository->findById($request->get('id'));
    }

}
