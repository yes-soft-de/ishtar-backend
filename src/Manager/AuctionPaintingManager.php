<?php


namespace App\Manager;



use App\Entity\AuctionPaintingEntity;
use App\Mapper\AuctionPaintingMapper;
use App\Mapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class AuctionPaintingManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $auctionPainting = json_decode($request->getContent(),true);
        $auctionPaintingEntity=new AuctionPaintingEntity();
        $auctionPaintingMapper = new AuctionPaintingMapper();
        $auctionPaintingData=$auctionPaintingMapper->auctionPaintingData($auctionPainting, $auctionPaintingEntity);
        $this->entityManager->persist($auctionPaintingData);
        $this->entityManager->flush();
        return $auctionPaintingData;
    }
    public function update(Request $request)
    {
        $auctionPainting = json_decode($request->getContent(),true);
        $auctionPaintingEntity=$this->entityManager->getRepository(AuctionPaintingEntity::class)->getAuctionPainting($request->get('id'));
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
        $auctionPainting=$this->entityManager->getRepository(AuctionPaintingEntity::class)->getAuctionPainting($request->get('id'));
        $this->entityManager->remove($auctionPainting);
        $this->entityManager->flush();
        return $auctionPainting;
    }
    public function getAll()
    {
        $data=$this->entityManager->getRepository(AuctionPaintingEntity::class)->getAll();

        return $data;
    }

    public function getAuctionPaintingById(Request $request)
    {
        return $result = $this->entityManager->getRepository(AuctionPaintingEntity::class)->findById($request->get('id'));
    }
    public function search(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->entityManager->getRepository(AuctionPaintingEntity::class)->search($data['keyword']);
    }
    public function getAllDetails()
    {
        $data=$this->entityManager->getRepository(AuctionPaintingEntity::class)->getAllDetails();

        return $data;
    }
}
