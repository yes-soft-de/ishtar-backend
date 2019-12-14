<?php


namespace App\Manager;



use App\Entity\AuctionEntity;
use App\Mapper\AuctionMapper;
use App\Mapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class AuctionManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $auction = json_decode($request->getContent(),true);
        $auctionEntity=new AuctionEntity();
        $auctionMapper = new AuctionMapper();
        $auctionData=$auctionMapper->auctionData($auction, $auctionEntity);
        $this->entityManager->persist($auctionData);
        $this->entityManager->flush();
        return $auctionData;
    }
    public function update(Request $request)
    {
        $auction = json_decode($request->getContent(),true);
        $auctionEntity=$this->entityManager->getRepository(AuctionEntity::class)->getAuction($request->get('id'));
        if (!$auctionEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("auction");
        }
        else {
            $auctionMapper = new AuctionMapper();
            $auctionMapper->AuctionData($auction, $auctionEntity);
            $this->entityManager->flush();
            return $auctionEntity;
        }
    }
    public function delete(Request $request)
    {
        $auction=$this->entityManager->getRepository(AuctionEntity::class)->getAuction($request->get('id'));
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
        $data=$this->entityManager->getRepository(AuctionEntity::class)->getAll();

        return $data;
    }

    public function getById(Request $request)
    {
        return $result = $this->entityManager->getRepository(AuctionEntity::class)->findById($request->get('id'));
    }
    public function search(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->entityManager->getRepository(AuctionEntity::class)->search($data['keyword']);
    }
    public function getAllDetails()
    {
        $data=$this->entityManager->getRepository(AuctionEntity::class)->getAllDetails();

        return $data;
    }
}
