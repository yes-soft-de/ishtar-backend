<?php


namespace App\Service;

use App\Controller\Auction;
use App\Manager\AuctionManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityMediaManger;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class AuctionService implements AuctionServiceInterface
{

    private $auctionManager;
    private $artTypeManager;
    private $mediaManager;

    public function __construct(AuctionManager $auctionManager)
    {
        $this->auctionManager=$auctionManager;
    }

    public function create($request)
    {
        $auctionResult =$this->auctionManager->create($request);
        return $auctionResult;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $auctionResult =$this->auctionManager->update($request);
        return $auctionResult;
    }
    public function getAll()
    {
        $result=$this->auctionManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->auctionManager->delete($request);
        return $result;
    }

    public function getById($request)
    {
        return $result = $this->auctionManager->getById($request);
    }

}