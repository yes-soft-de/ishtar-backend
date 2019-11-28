<?php


namespace App\Manager;



use App\AutoMapping;
use App\Entity\AuctionEntity;
use App\Repository\AuctionRepository;
use App\Request\ByIdRequest;
use App\Request\CreateAuctionRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateAuctionRequest;
use Doctrine\ORM\EntityManagerInterface;

class AuctionManager
{
    private $entityManager;
    private $auctionRepository;
    private $autoMapping;
    public function __construct(EntityManagerInterface $entityManagerInterface,AuctionRepository $auctionRepository,
AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->auctionRepository=$auctionRepository;
        $this->autoMapping=$autoMapping;
    }

    public function create(CreateAuctionRequest $request)
    {
        $auctionData=$this->autoMapping->map(CreateAuctionRequest::class,AuctionEntity::class,$request);
        $this->entityManager->persist($auctionData);
        $this->entityManager->flush();
        return $auctionData;
    }
    public function update(UpdateAuctionRequest $request)
    {
        $auctionEntity=$this->auctionRepository->find($request->getId());
        if (!$auctionEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("auction");
        }
        else {
            $auctionEntity=$auctionData=$this->autoMapping->mapToObject(UpdateAuctionRequest::class,
                AuctionEntity::class,$request,$auctionEntity);
            $this->entityManager->flush();
            return $auctionEntity;
        }
    }
    public function delete(DeleteRequest $request)
    {
        $auction=$this->auctionRepository->find($request->getId());
        if (!$auction) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $this->entityManager->remove($auction);
            $this->entityManager->flush();
        }
        return $auction;
    }
    public function getAll()
    {
        $data=$this->auctionRepository->findAll();

        return $data;
    }

    public function getById(ByIdRequest $request)
    {
        return $result = $this->auctionRepository->find($request->getId());
    }

}
