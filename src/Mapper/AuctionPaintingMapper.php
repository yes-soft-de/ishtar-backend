<?php

namespace App\Mapper;

use App\Entity\AuctionPaintingEntity;
use App\Entity\PaintingEntity;
use App\Entity\AuctionEntity;

class AuctionPaintingMapper
{
    private $en;
    public function auctionPaintingData($data, AuctionPaintingEntity $auctionPainting,$entityManager)
    {
        $this->en=$entityManager;
        $auction=$this->en->getRepository(AuctionEntity::class)->findBy(array(),array('id'=>'DESC'),1,1);
        $id= $auction[0]->getId()+1;
        $painting = $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);
        $auction= $this->en->getRepository(AuctionEntity::class)->find($id);
        $startPrice = $data["startPrice"];

        $auctionPainting->setPainting($painting)
            ->setAuction($auction)
            ->setStartPrice($startPrice);

        return $auctionPainting;
    }
}