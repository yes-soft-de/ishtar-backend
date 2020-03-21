<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\EntityMediaEntity;
use App\Manager\EntityMediaManger;
use App\Manager\EntityArtTypeManager;
use App\Response\CreateMediaResponse;
use App\Response\DeleteResponse;
use App\Response\GetAllMediaResponse;
use App\Response\GetEntityItemsResponse;
use App\Response\UpdateMediaResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class EntityMediaService implements EntityMediaServiceInterface
{

    private $entityMediaManager;
    private $autoMapping;
    public function __construct(EntityMediaManger $entityMediaManager,AutoMapping $autoMapping)
    {
        $this->entityMediaManager=$entityMediaManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $result=$this->entityMediaManager->create($request,null,null);
        $response=$this->autoMapping->map(EntityMediaEntity::class,CreateMediaResponse::class,$result);
        return $response;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $result =$this->entityMediaManager->updateMediaByID($request);
        $response=$this->autoMapping->map(EntityMediaEntity::class,UpdateMediaResponse::class,$result);
        return $response;
    }
    public function getAll()
    {
        $response =[];

        $result=$this->entityMediaManager->getAll();

        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map(EntityMediaEntity::class,GetAllMediaResponse::class,$row);
        }

        return $response;

    }
    public function delete($request)
    {
        $result=$this->entityMediaManager->deleteById($request);
        $response=$this->autoMapping->map('array',DeleteResponse::class,$result);
        return $response;
    }

    public function getEntityItems($request)
    {
        $response = [];

        $result= $this->entityMediaManager->getEntityItems($request);

        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetEntityItemsResponse::class,$row);
        }

        return $response;
    }

    public function updateMediaThumbImageById($request)
    {
        $result =$this->entityMediaManager->updateMediaThumbImageById($request);

        $response=$this->autoMapping->map(EntityMediaEntity::class,UpdateMediaResponse::class,$result);

        return $response;
    }

    public function updateMediaImageLink($request)
    {
        $result =$this->entityMediaManager->updateMediaImageLink($request);

        $response=$this->autoMapping->map(EntityMediaEntity::class,UpdateMediaResponse::class,$result);

        return $response;
    }
}