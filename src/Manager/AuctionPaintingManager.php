<?php


namespace App\Manager;



use App\AutoMapping;
use App\Entity\AuctionPaintingEntity;
use App\Mapper\AuctionPaintingMapper;
use App\Mapper\AutoMapper;
use App\Repository\AuctionPaintingEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateAuctionPaintingRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateAuctionPaintingRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class AuctionPaintingManager
{
    private $entityManager;
    private $auctionPaintingRepository;
    private $autoMapping;
    public function __construct(EntityManagerInterface $entityManagerInterface,
                                AuctionPaintingEntityRepository $auctionPaintingRepository,AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->auctionPaintingRepository=$auctionPaintingRepository;
        $this->autoMapping=$autoMapping;
    }

    public function create(CreateAuctionPaintingRequest $request)
    {
        $auctionPaintingData=$this->autoMapping->map(CreateAuctionPaintingRequest::class,
            AuctionPaintingEntity::class,$request);
        $this->entityManager->persist($auctionPaintingData);
        $this->entityManager->flush();
        return $auctionPaintingData;
    }
    public function update(UpdateAuctionPaintingRequest $request)
    {
        $auctionPaintingEntity=$this->auctionPaintingRepository->find($request->getId());
        if (!$auctionPaintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("auctionPainting");
        }
        else {
            $auctionPaintingEntity=$this->autoMapping->mapToObject(UpdateAuctionPaintingRequest::class,
                AuctionPaintingEntity::class,$request,$auctionPaintingEntity);;
            $this->entityManager->flush();
            return $auctionPaintingEntity;
        }
    }
    public function delete(DeleteRequest $request)
    {
        $auctionPainting=$this->auctionPaintingRepository->find($request->getId());
        $this->entityManager->remove($auctionPainting);
        $this->entityManager->flush();
        return $auctionPainting;
    }
    public function getAll()
    {
        $data=$this->auctionPaintingRepository->findAll();

        return $data;
    }

    public function getAuctionPaintingById(ByIdRequest $request)
    {
        return $result = $this->auctionPaintingRepository->find($request->getId());
    }
}
