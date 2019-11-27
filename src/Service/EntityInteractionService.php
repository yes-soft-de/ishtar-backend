<?php


namespace App\Service;

use App\Manager\EntityInteractionManager;

use App\Response\GetInteractionsClientResponse;
use App\Response\GetInteractionsEntityResponse;
use App\Response\GetInteractionsResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class EntityInteractionService implements EntityInteractionServiceInterface
{

    private $entityInteractionManager;


    public function __construct(EntityInteractionManager $entityInteractionManager)
    {
        $this->entityInteractionManager=$entityInteractionManager;
    }

    public function create($request)
    {
        $entityInteractionResult =$this->entityInteractionManager->create($request);
        return $entityInteractionResult;
    }
    public function update($request)
    {
        $entityInteractionResult =$this->entityInteractionManager->update($request);
        return $entityInteractionResult;
    }
    public function delete($request)
    {
        $entityInteractionResult =$this->entityInteractionManager->delete($request);
        return $entityInteractionResult;
    }

    public function getEntityInteraction($request)
    {
         $entityInteractionResult =$this->entityInteractionManager->getEntityInteraction($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetInteractionsentityResponse::class);
        $mapper = new AutoMapper($config);
        $response=$mapper->map($entityInteractionResult,GetInteractionsentityResponse::class);
        return $response;
    }

    public function getClientInteraction($request)
    {
         $entityInteractionResult =$this->entityInteractionManager->getClientInteraction($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetInteractionsClientResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($entityInteractionResult as $row)
            $response[]=$mapper->map($row,GetInteractionsClientResponse::class);
        return $response;
    }

    public function getAll($request)
    {
        $entityInteractionResault=$this->entityInteractionManager->getAll();
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetInteractionsResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($entityInteractionResault as $row)
            $response[]=$mapper->map($row,GetInteractionsResponse::class);
        return $response;

    }
    public function getMostViews()
    {
        return $entityInteractionResault=$this->entityInteractionManager->getMostViews();
    }
}