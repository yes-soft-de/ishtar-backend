<?php

namespace App\Mapper;

use App\Entity\AuctionEntity;
use DateTime;
use Exception;

class AuctionMapper
{
    public function auctionData($data, AuctionEntity $auction)
    {
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $startDate = new DateTime((string)$data["startDate"]);
            $endDate=new DateTime((string)$data["endDate"]);
        } catch (Exception $e) {
        }


        $auction->setStartDate($startDate)
            ->setEndDate($endDate);
        return $auction;
    }
}