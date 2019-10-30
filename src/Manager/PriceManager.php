<?php


namespace App\Manager;

use App\Entity\PriceEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\PriceMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PriceManager
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }
    public function create(Request $request,$entity)
    {
        $price= json_decode($request->getContent(),true);
        $priceEntity=new PriceEntity();
        $priceMapper = new PriceMapper();
        $priceData=$priceMapper->PriceData($price, $priceEntity,$this->entityManager,$entity);
        $this->entityManager->persist($priceData);
        $this->entityManager->flush();
        return $priceEntity;
    }

    public function update(Request $request,$entity)
    {
        $price = json_decode($request->getContent(),true);
        $priceEntity=$this->entityManager->getRepository(PriceEntity::class)
            ->findEntity($request->get('id'),$entity);
        if (!$priceEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("price");
        }
        else {
            $priceEntity->setPrice($price['price']);
            $this->entityManager->flush();
            return $priceEntity;
        }
    }
//    public function update(UpdatePriceRequest $price)
//    {
//        $priceEntity=$this->entityManager->getRepository(PriceEntity::class)->find($price->getId());
//
//        if (!$priceEntity) {
//            $exception=new EntityException();
//            $exception->entityNotFound("price");
//        }
//        else {
//            $data = $this->autoMapper->Map($price, $priceEntity);
//            $this->entityManager->flush();
//            return $priceEntity;
//        }
//    }
//    public function getAll()
//    {
//        $pricesLists[]=new PricesListResponse();
//        $data=$this->entityManager->getRepository(PriceEntity::class)->findAll();
//        $i=0;
//        foreach ($pricesLists as &$list) {
//            $list = $this->autoMapper->map((object)$data[$i],$list);
//            $i++;
//        }
//        return $pricesLists;
//    }

}
