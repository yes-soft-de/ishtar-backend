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
        $auction=$this->en->getRepository(AuctionEntity::class)->find($data["auction"]);
        $painting = $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);
        $startPrice = $data["startPrice"];
        $finalPrice = $data["finalPrice"];

        $auctionPainting->setPainting($painting)
            ->setAuction($auction)
            ->setStartPrice($startPrice)
            ->setFinalPrice($finalPrice);

        return $auctionPainting;
    }
}