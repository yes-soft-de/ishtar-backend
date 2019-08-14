<?php

namespace App\Mapper;

use App\Entity\ClientEntity;
use App\Entity\PaintingEntity;
use App\Entity\PaintingTransactionEntity;
use DateTime;
use Exception;

class PaintingTransactionMapper
{
    private $en;
    public function paintingTransactionData($data, PaintingTransactionEntity $paintingTransaction,$entityManger)
    {
        $this->en=$entityManger;
        $painting= $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);
        $client = $this->en->getRepository(ClientEntity::class)->find($data["client"]);
        $date   = $data["date"];
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $date = new DateTime((string)$data["date"]);
        } catch (Exception $e) {
        }
        $price = $data["price"];

        $paintingTransaction->setPainting($painting)
            ->setClient($client)
            ->setDate($date)
            ->setPrice($price);

        return $paintingTransaction;
    }
}