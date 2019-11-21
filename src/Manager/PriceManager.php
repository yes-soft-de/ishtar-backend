<?php


namespace App\Manager;

use App\Entity\PriceEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\PriceMapper;
use App\Repository\EntityRepository;
use App\Repository\PriceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PriceManager
{
    private $entityManager;
    private $priceRepository;
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,PriceEntityRepository $priceRepository
    ,EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->priceRepository=$priceRepository;
        $this->entityRepository=$entityRepository;
    }
    public function create($request,$entity,$id)
    {
        $priceEntity=new PriceEntity();
        $priceEntity->setEntity($this->entityRepository->find($entity))
            ->setRow($id)
            ->setPrice($request->getPrice());
        $this->entityManager->persist($priceEntity);
        $this->entityManager->flush();
        return $priceEntity;
    }

    public function update($request,$entity)
    {
        $id=$request->getId();
        $priceEntity=$this->priceRepository->findEntity($id,$entity);
        $priceEntity[0]->setEntity($this->entityRepository->find($entity))
            ->setRow($id)
            ->setPrice($request->getPrice());
        $this->entityManager->flush();
        return $priceEntity;
    }
    public function delete(Request $request,$entity)
    {
        $price = $this->priceRepository->findEntity($request->get('id'), $entity);
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
