<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\EntityMediaEntity;
use App\Manager\EntityMediaManger;
use App\Manager\EntityArtTypeManager;
use App\Response\DeleteResponse;
use App\Response\GetAllMediaResponse;
use App\Response\GetEntityItemsResponse;
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
    private $autoMapping;
    public function __construct(EntityMediaManger $entityMediaManager,AutoMapping $autoMapping)
    {
        $this->entityMediaManager=$entityMediaManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $entityMediaResult =$this->entityMediaManager->create($request,null,null);
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
        foreach ($result as $row)
        $response[]=$this->autoMapping->map(EntityMediaEntity::class,GetAllMediaResponse::class,$row);
        return $response;

    }
    public function delete($request)
    {
        $result=$this->entityMediaManager->deleteById($request);
        $response=$this->autoMapping->map('array',DeleteResponse::class,$result);
        return $result;
    }

    public function getById($request)
    {
        return $result = $this->entityMediaManager->getById($request);
    }

    public function getEntityItems($request)
    {
        $result= $this->entityMediaManager->getEntityItems($request);
        foreach ($result as $row)
            $response[]=$this->autoMapping->map('array',GetEntityItemsResponse::class,$row);
        return $response;
    }
}