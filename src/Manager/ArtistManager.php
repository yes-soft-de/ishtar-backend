<?php


namespace App\Manager;

use App\Entity\ArtistEntity;
use App\Mapper\ArtistMapper;
use App\Repository\ArtistEntityRepository;
use App\Request\CreateArtistRequest;
use App\Request\UpdateArtistRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class ArtistManager
{
    private $entityManager;
    private $artistRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,ArtistEntityRepository $artistEntityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->artistRepository=$artistEntityRepository;
    }

    public function create(CreateArtistRequest $request)
    {
        $artistEntity=new ArtistEntity();
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateArtistRequest::class, ArtistEntity::class);
        $mapper = new AutoMapper($config);
        $artistEntity=$mapper->mapToObject($request,$artistEntity);
        $artistEntity->setCreateDate();
        $artistEntity->setBirthDate($request->getBirthDate());
        $this->entityManager->persist($artistEntity);
        $this->entityManager->flush();
        return $artistEntity;
    }
    public function update(UpdateArtistRequest $request)
    {
        $artistEntity=$this->artistRepository->getArtist($request->getId());
            if (!$artistEntity) {
                $exception = new EntityException();
                $exception->entityNotFound("artist");
            } else {
                $config = new AutoMapperConfig();
                $config->registerMapping(UpdateArtistRequest::class,ArtistEntity::class);
                $mapper = new AutoMapper($config);
                $artistEntity=$mapper->map($request,ArtistEntity::class);
                $artistEntity->setBirthDate($request->getBirthDate());
                $artistEntity->setUpdateDate();
                $this->entityManager->flush();
                return $artistEntity;
            }

    }
    public function delete($request)
    {
        $artist=$this->artistRepository->getArtist($request->getId());
        if (!$artist) {
            $exception=new EntityException();
            $exception->entityNotFound("artist");
        }
        else {
            $artist->setIsActive(false);
            $this->entityManager->flush();
        }
        return $artist;
    }
    public function getAll()
    {
        $data=$this->artistRepository->getAll();

        return $data;
    }

    public function getArtistById($request)
    {
        return $result = $this->artistRepository->findById($request->getId());
    }
    public function search(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->artistRepository->search($data['keyword']);
    }
    public function getAllDetails()
    {
        $data=$this->artistRepository->getAllDetails();

        return $data;
    }
}
