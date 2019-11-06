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
    public function create(Request $request,$entity,$id)
    {
        $entityMedia= json_decode($request->getContent(),true);
        $entityMediaEntity=new EntityMediaEntity();
        $entityMediaMapper = new entityMediaMapper();
        $entityMediaData=$entityMediaMapper->MediaEntityData($entityMedia, $entityMediaEntity,$this->entityManager,$entity,$id);
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
    public function delete(Request $request,$entity)
    {
        if(!isset($entity))
            $entity=$request->get('entity');
        $media=$this->entityManager->getRepository(EntityMediaEntity::class)
            ->findImages($request->get('id'),$entity);
        if (!$media) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $this->entityManager->remove($media);
            $this->entityManager->flush();
        }
    }
    public function getAll()
    {
        $entityMediasLists[]=new EntityMediasListResponse();
        $data=$this->entityManager->getRepository(EntityMediaEntity::class)->findAll();
        $i=0;
        foreach ($entityMediasLists as &$list) {
            $list = $this->autoMapper->map((object)$data[$i],$list);
            $i++;
        }
        return $entityMediasLists;
    }

}
