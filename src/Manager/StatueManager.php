<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ArtistEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\StatueEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\StatueMapper;
use App\Repository\ArtistEntityRepository;
use App\Repository\StatueEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateStatueRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateStatueRequest;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class StatueManager
{
    private $entityManager;
    private $statueRepository;
    private $artistRepository;
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface,StatueEntityRepository $statueRepository,
    ArtistEntityRepository $artistRepository,AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->statueRepository=$statueRepository;
        $this->artistRepository=$artistRepository;
        $this->autoMapping=$autoMapping;
    }

    public function create(CreateStatueRequest $request)
    {
        $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
        $statueData=$this->autoMapping->map(CreateStatueRequest::class,StatueEntity::class,$request);
        $statueData->setCreateDate();
        $this->entityManager->persist($statueData);
        $this->entityManager->flush();
        return $statueData;
    }
    public function update(UpdateStatueRequest $request)
    {
        $statueEntity=$this->statueRepository->find($request->getId());
        if (!$statueEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("statue");
        }
        else {
            $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
            $statueEntity=$this->autoMapping->mapToObject(UpdateStatueRequest::class,StatueEntity::class,
                $request,$statueEntity);
            $statueEntity->setUpdatedDate();
            $this->entityManager->flush();
            return $statueEntity;
        }
    }
    public function delete(DeleteRequest $request)
    {
        $statueEntity=$this->statueRepository->find($request->getId());
        if (!$statueEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("statue");
        }
        else {
        $statueEntity->setActive(0);
            $this->entityManager->flush();
            return $statueEntity;
        }
    }
    public function getAll()
    {
        $data=$this->statueRepository->getAll();

        return $data;
    }

    public function getStatueById(ByIdRequest $request)
    {
        return $result = $this->statueRepository->getStatue($request->getId());
    }

}
