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


    public function __construct(EntityManagerInterface $entityManagerInterface,BaseFetchDataMapperInterface $baseFetchDataMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->baseFetchDataMapper=$baseFetchDataMapper;

    }
    public function fetchData(Request $request, $entity)
    {
        $data = $this->baseFetchDataMapper->fetchDataMapper($request, $entity);


        return $data;
    }


}