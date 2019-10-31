<?php


namespace App\Service;

use App\Manager\EntityInteractionManager;

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
        return $entityInteractionResult =$this->entityInteractionManager->getEntityInteraction($request);
    }

    public function getClientInteraction($request)
    {
        return $entityInteractionResult =$this->entityInteractionManager->getClientInteraction($request);
    }

    public function getAll($request)
    {
       return $entityInteractionResault=$this->entityInteractionManager->getAll();
    }
}