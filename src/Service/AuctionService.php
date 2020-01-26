<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\AuctionEntity;
use App\Manager\AuctionManager;
use App\Response\CreateAuctionResponse;
use App\Response\DeleteResponse;
use App\Response\UpdateAuctionResponse;


class AuctionService implements AuctionServiceInterface
{

    private $auctionManager;
   private $autMapping;

    public function __construct(AuctionManager $auctionManager,AutoMapping $autoMapping)
    {
        $this->auctionManager=$auctionManager;
        $this->autMapping=$autoMapping;
    }

    public function create($request)
    {
        $auctionResult =$this->auctionManager->create($request);
        $response=$this->autMapping->map(AuctionEntity::class,CreateAuctionResponse::class,$auctionResult);
        return $response;
    }
    public function update($request)
    {
        $auctionResult =$this->auctionManager->update($request);
        $response=$this->autMapping->map(AuctionEntity::class,UpdateAuctionResponse::class,$auctionResult);
        return $response;
    }
    public function getAll()
    {
        $result=$this->auctionManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->auctionManager->delete($request);
        $response=new DeleteResponse($result->getId());
        return $response;

    }

    public function getById($request)
    {
        return $result = $this->auctionManager->getById($request);
    }

}