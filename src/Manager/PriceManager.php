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
    public function create(Request $request,$entity,$id)
    {
        $price= json_decode($request->getContent(),true);
        $priceEntity=new PriceEntity();
        $priceMapper = new PriceMapper();
        $priceData=$priceMapper->PriceData($price, $priceEntity,$this->entityManager,$entity,$id);
        $this->entityManager->persist($priceData);
        $this->entityManager->flush();
        return $priceEntity;
    }

    public function update(Request $request,$entity)
    {
        $id=$request->get('id');
        $price = json_decode($request->getContent(),true);
        $priceEntity=new PriceEntity();
        $priceMapper = new PriceMapper();
        $priceData=$priceMapper->PriceData($price, $priceEntity,$this->entityManager,$entity,$id);
        $this->entityManager->persist($priceData);
        $this->entityManager->flush();
        return $priceEntity;
    }
    public function delete(Request $request,$entity)
    {
        $price = $this->entityManager->getRepository(PriceEntity::class)
            ->findEntity($request->get('id'), $entity);
        if (!$price) {
            $exception = new EntityException();
            $exception->entityNotFound("artType");
        } else {
            foreach ($price as $list) {
                $this->entityManager->remove($list);
            }
            $this->entityManager->flush();
        }
    }
//    public function getAll()
//    {
//        $pricesLists[]=new PricesListResponse();
//        $data=$this->entityManager->getRepository(PriceEntity::class)->findAll();
//        $i=0;
//
//            $list = $this->autoMapper->map((object)$data[$i],$list);
//            $i++;
//        }
//        return $pricesLists;
//    }

}
