<?php


namespace App\Manager;

use App\Entity\EntityMediaEntity;
use App\Mapper\EntityMediaMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityMediaManger
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }
    public function create(Request $request,$entity)
    {
        $entityMedia= json_decode($request->getContent(),true);
        $entityMediaEntity=new EntityMediaEntity();
        $entityMediaMapper = new entityMediaMapper();
        $entityMediaData=$entityMediaMapper->MediaEntityData($entityMedia, $entityMediaEntity,$this->entityManager,$entity);
        $this->entityManager->persist($entityMediaData);
        $this->entityManager->flush();
        return $entityMediaEntity;
    }
    public function update(Request $request,$entity)
    {
        $entityMedia = json_decode($request->getContent(),true);
        $entityMediaEntity=$this->entityManager->getRepository(EntityMediaEntity::class)->findImages($request->get('id'),$entity);
        if (!$entityMediaEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityMedia");
        }
        else {
           $entityMediaEntity->setPath($entityMedia['image']);
            $this->entityManager->flush();
            return $entityMediaEntity;
        }
    }
//    public function update(UpdateEntityMediaRequest $entityMedia)
//    {
//        $entityMediaEntity=$this->entityManager->getRepository(EntityMediaEntity::class)->find($entityMedia->getId());
//
//        if (!$entityMediaEntity) {
//            $exception=new EntityException();
//            $exception->entityNotFound("entityMedia");
//        }
//        else {
//            $data = $this->autoMapper->Map($entityMedia, $entityMediaEntity);
//            $this->entityManager->flush();
//            return $entityMediaEntity;
//        }
//    }
//    public function getAll()
//    {
//        $entityMediasLists[]=new EntityMediasListResponse();
//        $data=$this->entityManager->getRepository(EntityMediaEntity::class)->findAll();
//        $i=0;
//        foreach ($entityMediasLists as &$list) {
//            $list = $this->autoMapper->map((object)$data[$i],$list);
//            $i++;
//        }
//        return $entityMediasLists;
//    }

}
