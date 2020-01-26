<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ArtistEntity;
use App\Repository\ArtistEntityRepository;
use App\Repository\ReportRepository;
use App\Request\ByIdRequest;
use App\Request\CreateArtistRequest;
use App\Request\DeleteRequest;
use App\Request\GetArtistRequest;
use App\Request\UpdateArtistRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArtistManager
{
    private $entityManager;
    private $artistRepository;
    private $autoMapping;
    private $reportRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                ArtistEntityRepository $artistEntityRepository, AutoMapping $autoMapping,
                                ReportRepository $reportRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->artistRepository = $artistEntityRepository;
        $this->autoMapping = $autoMapping;
        $this->reportRepository = $reportRepository;
    }

    public function create(CreateArtistRequest $request)
    {
        $artistEntity = $this->autoMapping->map(CreateArtistRequest::class, ArtistEntity::class, $request);
        $artistEntity->setCreateDate();
        $artistEntity->setBirthDate($request->getBirthDate());
        $artistEntity->setIsActive(true);
        $this->entityManager->persist($artistEntity);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return $artistEntity;
    }

    public function update(UpdateArtistRequest $request)
    {
        $artistEntity = $this->artistRepository->getArtist($request->getId());
        if (!$artistEntity) {
            $exception = new EntityException();
            $exception->entityNotFound("artist");
        } else {
            $artistEntity = $artistEntity = $this->autoMapping->mapToObject(UpdateArtistRequest::class,
                ArtistEntity::class, $request, $artistEntity);
            $artistEntity->setBirthDate($request->getBirthDate());
            $artistEntity->setUpdateDate();
            $this->entityManager->flush();
            return $artistEntity;
        }
    }

    public function delete(DeleteRequest $request)
    {
        $artist = $this->artistRepository->getArtist($request->getId());
        if (!$artist) {
            $exception = new EntityException();
            $exception->entityNotFound("artist");
        } else {
            $artist->setIsActive(false);
            $this->entityManager->flush();
        }
        return $artist;
    }

    public function getAll()
    {
        $data = $this->artistRepository->getAll();

        return $data;
    }

    public function getArtistById(GetArtistRequest $request)
    {
        return $result = $this->artistRepository->findById($request->getId());
    }

    public function search(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $result = $this->artistRepository->search($data['keyword']);
    }

    public function getAllDetails()
    {
        $data = $this->artistRepository->getAllDetails();

        return $data;
    }

    public function isReportSent($artist)
    {
        $result = $this->reportRepository->findReportByArtist($artist->getId());
        if (isset($result))
            return true;
        else return false;
    }

    public function getArtistPaintings($artist)
    {
        return $this->artistRepository->getArtistPaintings($artist);
    }
}
