<?php


namespace App\Service;

use App\Controller\AuctionPainting;
use App\Manager\AuctionPaintingManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityMediaManger;
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

    public function __construct(AuctionPaintingManager $auctionPaintingManager,EntityArtTypeManager $artTypeManager,EntityMediaManger $entityMediaManager)
    {
        $this->auctionPaintingManager=$auctionPaintingManager;
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
    }

    public function create($request)
    {
        $auctionPaintingResult =$this->auctionPaintingManager->create($request);
        $artTypeResult=$this->artTypeManager->create($request,2);
        $mediaResault=$this->mediaManager->create($request,2);
        return $auctionPaintingResult;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $auctionPaintingResult =$this->auctionPaintingManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,2);
        $mediaResault=$this->mediaManager->update($request,2);
        return $auctionPaintingResult;
    }
    public function getAll()
    {
        $result=$this->auctionPaintingManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->auctionPaintingManager->delete($request);
        $this->mediaManager->delete($request,2);
        $this->artTypeManager->delete($request,2);
        return $result;
    }

    public function getById($request)
    {
        return $result = $this->auctionPaintingManager->getAuctionPaintingById($request);
    }

    public function search(Request $request)
    {
        return $result=$this->auctionPaintingManager->search($request);
    }

    public function getAllDetails()
    {
        $result=$this->auctionPaintingManager->getAllDetails();
        return $result;
    }
}