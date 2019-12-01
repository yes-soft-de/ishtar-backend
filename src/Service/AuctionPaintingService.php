<?php


namespace App\Service;

use App\AutoMapping;
use App\Controller\AuctionPainting;
use App\Entity\AuctionPaintingEntity;
use App\Manager\AuctionPaintingManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityMediaManger;
use App\Request\CreateAuctionPaintingRequest;
use App\Response\CreateAuctionPaintingResponse;
use App\Response\DeleteResponse;
use App\Response\GetPaintingsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class AuctionPaintingService implements AuctionPaintingServiceInterface
{

    private $auctionPaintingManager;
    private $artTypeManager;
    private $mediaManager;
    private $autoMapping;

    public function __construct(AuctionPaintingManager $auctionPaintingManager,EntityArtTypeManager $artTypeManager
        ,EntityMediaManger $entityMediaManager,AutoMapping $autoMapping)
    {
        $this->auctionPaintingManager=$auctionPaintingManager;
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $auctionPaintingResult =$this->auctionPaintingManager->create($request);
        $response=$this->autoMapping->map(AuctionPaintingEntity::class,CreateAuctionPaintingResponse::class
        ,$auctionPaintingResult);
        return $response;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $auctionPaintingResult =$this->auctionPaintingManager->update($request);
        $response=$this->autoMapping->map(AuctionPaintingEntity::class,CreateAuctionPaintingResponse::class
            ,$auctionPaintingResult);
        return $response;
    }
    public function getAll()
    {
        $result=$this->auctionPaintingManager->getAll();
        foreach ($result as $row)
            $response[]=$this->autoMapping->map('array',GetPaintingsResponse::class,$row);
        return $result;
    }
    public function delete($request)
    {
        $result=$this->auctionPaintingManager->delete($request);
        $this->mediaManager->delete($request,2);
        $this->artTypeManager->delete($request,2);
        $response=new DeleteResponse($result->getId());
        return $response;
    }

    public function getById($request)
    {
        return $result = $this->auctionPaintingManager->getAuctionPaintingById($request);
    }

}