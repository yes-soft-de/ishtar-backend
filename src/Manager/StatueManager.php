<?php


namespace App\Manager;

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
use App\Request\CreateStatueRequest;
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
    public function __construct(EntityManagerInterface $entityManagerInterface,StatueEntityRepository $statueRepository,
    ArtistEntityRepository $artistRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->statueRepository=$statueRepository;
        $this->artistRepository=$artistRepository;
    }

    public function create($request)
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateStatueRequest::class, StatueEntity::class);
        $mapper = new \AutoMapperPlus\AutoMapper($config);
        $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
        $statueData=$mapper->map($request,StatueEntity::class);
        $statueData->setCreateDate();
        $this->entityManager->persist($statueData);
        $this->entityManager->flush();
        return $statueData;
    }
    public function update($request)
    {
        $statueEntity=$this->statueRepository->getStatue($request->getId());
        if (!$statueEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("statue");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(UpdateStatueRequest::class, StatueEntity::class);
            $mapper = new \AutoMapperPlus\AutoMapper($config);
            $request->setArtist($this->artistRepository->getArtist($request->getArtist()));
            $statueEntity=$mapper->mapToObject($request,$statueEntity);
            $statueEntity->setUpdatedDate();
            $this->entityManager->flush();
            return $statueEntity;
        }
    }
    public function delete(Request $request)
    {
        $statueEntity=$this->statueRepository->getStatue($request->get('id'));
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

    public function getStatueById($request)
    {
        return $result = $this->statueRepository->findOneById($request);
    }

}
