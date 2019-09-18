<?php


namespace App\Manager;


use App\Entity\ArtistArtTypeEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\AuctionEntity;
use App\Entity\AuctionPaintingEntity;
use App\Entity\ClapEntity;
use App\Entity\ClientEntity;
use App\Entity\CommentEntity;
use App\Entity\ImageEntity;
use App\Entity\InteractionEntity;
use App\Entity\PaintingEntity;
use App\Entity\PaintingTransactionEntity;
use App\Entity\VideoEntity;
use App\Mapper\BaseCreateMapperInterface;
use App\Mapper\BaseDeleteMapperInterface;
use App\Mapper\BaseFetchDataMapperInterface;
use App\Mapper\BaseMapperInterface;
use App\Mapper\BaseUpdateMapperInterface;
use App\Service\FetchDataServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FetchDataManger implements FetchDataMangerInterface
{
    private $entityManager;
    private $baseFetchDataMapper;


    public function __construct(EntityManagerInterface $entityManagerInterface, BaseFetchDataMapperInterface $baseFetchDataMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->baseFetchDataMapper = $baseFetchDataMapper;

    }

    public function fetchData(Request $request, $entity)
    {
        $data = $this->baseFetchDataMapper->fetchDataMapper($request, $entity);


        return $data;
    }

    public function getArtistPaintings(Request $request)
    {
        $data = $this->baseFetchDataMapper->getArtistPaintings($request);

        return $data;
    }

    public function getPaintingById(Request $request)
    {
        $data = $this->baseFetchDataMapper->getPaintingById($request);

        return $data;
    }

    public function getPaintingImages(Request $request)
    {
        $data = $this->baseFetchDataMapper->getPaintingImages($request);

        return $data;
    }

    public function getArtistById(Request $request)
    {
        $data = $this->baseFetchDataMapper->getArtistById($request);

        return $data;
    }

    public function getArtTypeById(Request $request)
    {
        $data = $this->baseFetchDataMapper->getArtTypeById($request);

        return $data;
    }

    public function getClientById(Request $request)
    {
        $data = $this->baseFetchDataMapper->getClientById($request);
        return $data;
    }

    public function getArtTypePaintings(Request $request)
    {
        $data = $this->baseFetchDataMapper->getArtTypePaintings($request);
        return $data;
    }

    public function getAuctionById(Request $request)
    {
        $data = $this->baseFetchDataMapper->getAuctionById($request);
        return $data;
    }

    public function getBy(Request $request)
    {
        $data = $this->baseFetchDataMapper->getBy($request);
        return $data;
    }

    public function getPaintingShort()
    {
        $data = $this->baseFetchDataMapper->getPaintingShort();
        return $data;
    }

    public function getArtTypeList()
    {
        $data = $this->baseFetchDataMapper->getArtTypeList();
        return $data;
    }

    public function getArtistsData($request)
    {
        $data = $this->baseFetchDataMapper->getArtistsData($request);
        return $data;
    }

    public function getEntityNames($request)
    {
        $data = $this->baseFetchDataMapper->getEntityNames($request);
        return $data;
    }
    public function getEntityInteraction($request)
    {
        $data = $this->baseFetchDataMapper->getEntityInteraction($request);
        return $data;
    }
    public function getEntityComment($request)
    {
        $data = $this->baseFetchDataMapper->getEntityComment($request);
        return $data;
    }
    public function getEntityClap($request)
    {
        $data = $this->baseFetchDataMapper->getEntityClap($request);
        return $data;
    }
}