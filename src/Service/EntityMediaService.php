<?php


namespace App\Service;

use App\Manager\EntityMediaManger;
use App\Manager\EntityArtTypeManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class EntityMediaService implements EntityMediaServiceInterface
{

    private $entityMediaManager;
    private $artTypeManager;
    private $mediaManager;

    public function __construct(EntityMediaManger $entityMediaManager)
    {
        $this->entityMediaManager=$entityMediaManager;
    }

    public function create(Request $request)
    {
        $entityMedia= json_decode($request->getContent(),true);
        $entity=$entityMedia['entity'];
        $row=$entityMedia['row'];
        $entityMediaResult =$this->entityMediaManager->create($request,$entity,$row);
        return $entityMediaResult;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $entityMediaResult =$this->entityMediaManager->updateMediaByID($request);
        return $entityMediaResult;
    }
    public function getAll()
    {
        $result=$this->entityMediaManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->entityMediaManager->deleteById($request);
        return $result;
    }

    public function getById($request)
    {
        return $result = $this->entityMediaManager->getById($request);
    }

    public function getEntityItems($request)
    {
        return $this->entityMediaManager->getEntityItems($request);
    }
}