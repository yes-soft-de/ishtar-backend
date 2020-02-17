<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\EntityInteractionEntity;
use App\Manager\EntityInteractionManager;

use App\Response\CreateInteractionResponse;
use App\Response\DeleteResponse;
use App\Response\GetInteractionsClientResponse;
use App\Response\GetInteractionsEntityResponse;
use App\Response\GetInteractionsResponse;
use App\Response\GetMostViewsResponse;
use App\Response\UpdateInteractionResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;

class EntityInteractionService implements EntityInteractionServiceInterface
{

    private $entityInteractionManager;
    private $autoMapping;

    public function __construct(EntityInteractionManager $entityInteractionManager,AutoMapping $autoMapping)
    {
        $this->entityInteractionManager=$entityInteractionManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $entityInteractionResult = $this->entityInteractionManager->create($request);

        $response=$this->autoMapping->map(EntityInteractionEntity::class,CreateInteractionResponse::class,
            $entityInteractionResult);

        return $response;
    }

    public function update($request)
    {
        $entityInteractionResult =$this->entityInteractionManager->update($request);
        $response=$this->autoMapping->map(EntityInteractionEntity::class,UpdateInteractionResponse::class,
            $entityInteractionResult);
        return $response;
    }
    public function delete($request)
    {
        $result =$this->entityInteractionManager->delete($request);
        $response=new DeleteResponse($result->getId());
        return $response;

    }

    public function getEntityInteraction($request)
    {
        new GetInteractionsEntityResponse();
         $entityInteractionResult = $this->entityInteractionManager->getEntityInteraction($request);
            $response=$this->autoMapping->map('array',GetInteractionsEntityResponse::class
            ,$entityInteractionResult[0]);
        return $response;
    }

    public function getClientInteraction($request)
    {
        $response = [];
         $entityInteractionResult =$this->entityInteractionManager->getClientInteraction($request);
        foreach ($entityInteractionResult as $row)
        {
            $response[]=$this->autoMapping->map('array',GetInteractionsClientResponse::class,$row);
        }

        return $response;
    }

    public function getAll($request)
    {
        $response = [];
        $entityInteractionResault=$this->entityInteractionManager->getAll();
        foreach ($entityInteractionResault as $row)
        {
            $response[]=$this->autoMapping->map('array',GetInteractionsResponse::class,$row);
        }

        return $response;

    }
    public function getMostViews()
    {
        $response = [];
        $entityInteractionResault=$this->entityInteractionManager->getMostViews();
        foreach ($entityInteractionResault as $row)
        {
            $response[]=$this->autoMapping->map('array',GetMostViewsResponse::class,$row);
        }

        return $response;
    }
}