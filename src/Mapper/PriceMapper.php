<?php

namespace App\Mapper;
use App\Entity\PaintingEntity;
use App\Entity\PriceEntity;

class PriceMapper
{
    private $en;
    public function PriceData($data, PriceEntity $PriceEntity,$entityManger)
    {
        $this->en=$entityManger;
        $price = $data['price'];
            $row = $this->en->getRepository(PaintingEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
        if(!isset($row[0]))
            $row=1;
        else
            $row= $row[0]->getId()+1;


        $painting=$this->en->getRepository(PaintingEntity::class)->find($row);
        $PriceEntity->setPrice($price)
            ->setPainting($painting);


        return $PriceEntity;
    }
}