<?php

namespace App\Mapper;
use App\Entity\Entity;
use App\Entity\PaintingEntity;
use App\Entity\PriceEntity;
use App\Entity\StatueEntity;

class PriceMapper
{
    private $en;
    public function PriceData($data, PriceEntity $PriceEntity,$entityManger,$entity,$id)
    {
//        $this->en=$entityManger;
//
//        if($entityId==1) {
//            $row = $this->en->getRepository(PaintingEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
//            if(!isset($row[0]))
//                $row=1;
//            else
//                $row= $row[0]->getId()+1;
//        }
//        else if($entityId==6)
//        {
//            $row = $this->en->getRepository(StatueEntity::class)->findBy(array(), array('id' => 'DESC'), 1, 1);
//            if(!isset($row[0]))
//                $row=1;
//            else
//                $row= $row[0]->getId()+1;
//        }
        $price = $data['price'];
        $entity = $entityManger->getRepository(Entity::class)->find($entity);
        $PriceEntity->setPrice($price)
            ->setEntity($entity)
            ->setRow($id);
        return $PriceEntity;
    }
}