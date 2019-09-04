<?php

namespace App\Mapper;
use App\Entity\PaintingEntity;
use App\Entity\PriceEntity;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use phpDocumentor\Reflection\Types\This;

class PriceMapper
{
    private $en;
    public function PriceData($data, PriceEntity $PriceEntity,$entityManger)
    {
        $this->en=$entityManger;
        $price = $data['price'];
        $row=$this->en->getRepository(PaintingEntity::class)->findBy(array(),array('id'=>'DESC'),1,1);
        $id= $row[0]->getId()+1;
        $painting=$this->en->getRepository(PaintingEntity::class)->find($id);
        $PriceEntity->setPrice($price)
            ->setPainting($painting);

        return $PriceEntity;
    }
}