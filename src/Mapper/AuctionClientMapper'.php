<?php

namespace App\Mapper;

use App\Entity\AuctionClientEntity;
use App\Entity\PaintingEntity;
use App\Entity\AuctionEntity;

class AuctionClientMapper
{
    private $en;
    public function auctionClientData($data, AuctionClientEntity $auctionClientEntity,$entityManager)
    {
        $this->en=$entityManager;
        $auction=$this->en->getRepository(AuctionEntity::class)->findBy(array(),array('id'=>'DESC'),1,1);
        $id= $auction[0]->getId()+1;
        $painting = $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);
        $auction= $this->en->getRepository(AuctionEntity::class)->find($id);
        $startPrice = $data["startPrice"];

        $auctionClientEntity->setAuction($auction)
            ->setState($state)
            ->setApplicationDate($applicationDate)
            ->setClient($client);

        return  $auctionClientEntity;
    }
}