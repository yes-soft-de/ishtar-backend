<?php


namespace App\Manager;



use App\Entity\AuctionPaintingEntity;
use App\Mapper\AuctionPaintingMapper;
use App\Mapper\AutoMapper;
use App\Repository\AuctionPaintingEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class AuctionPaintingManager
{
    private $entityManager;
    private $auctionPaintingRepository;
    public function __construct(EntityManagerInterface $entityManagerInterface,
                                AuctionPaintingEntityRepository $auctionPaintingRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->auctionPaintingRepository=$auctionPaintingRepository;
    }

    public function create(Request $request)
    {
        $auctionPainting = json_decode($request->getContent(),true);
        $auctionPaintingEntity=new AuctionPaintingEntity();
        $auctionPaintingMapper = new AuctionPaintingMapper();
        $auctionPaintingData=$auctionPaintingMapper->auctionPaintingData($auctionPainting, $auctionPaintingEntity,
            $this->entityManager);
        $this->entityManager->persist($auctionPaintingData);
        $this->entityManager->flush();
        return $auctionPaintingData;
    }
    public function update(Request $request)
    {
        $auctionPainting = json_decode($request->getContent(),true);
        $auctionPaintingEntity=$this->auctionPaintingRepository->getAuctionPainting($request->get('id'));
        if (!$auctionPaintingEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("auctionPainting");
        }
        else {
            $auctionPaintingMapper = new AuctionPaintingMapper();
            $auctionPaintingMapper->AuctionPaintingData($auctionPainting, $auctionPaintingEntity);
            $this->entityManager->flush();
            return $auctionPaintingEntity;
        }
    }
    public function delete(Request $request)
    {
        $auctionPainting=$this->auctionPaintingRepository->getAuctionPainting($request->get('id'));
        $this->entityManager->remove($auctionPainting);
        $this->entityManager->flush();
        return $auctionPainting;
    }
    public function getAll()
    {
        $data=$this->auctionPaintingRepository->getAll();

        return $data;
    }

    public function getAuctionPaintingById(Request $request)
    {
        return $result = $this->auctionPaintingRepository->findById($request->get('id'));
    }

    public function getAllDetails()
    {
        $data=$this->auctionPaintingRepository->getAllDetails();

        return $data;
    }
}
