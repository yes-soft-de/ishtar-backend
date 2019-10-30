<?php


namespace App\Manager;


use App\Entity\EntityInteractionEntity;
use App\Mapper\EntityInteractionMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityInteractionManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $entityInteraction = json_decode($request->getContent(),true);
        $entityInteractionEntity=new EntityInteractionEntity();
        $entityInteractionMapper = new EntityInteractionMapper();
        $entityInteractionData=$entityInteractionMapper->entityInteractionData($entityInteraction,$entityInteractionEntity,$this->entityManager);
        $this->entityManager->persist($entityInteractionData);
        $this->entityManager->flush();
        return $entityInteractionData;
    }
    public function update(Request $request)
    {
        $entityInteraction = json_decode($request->getContent(),true);
        $entityInteractionEntity=$this->entityManager->getRepository(EntityInteractionEntity::class)->find($entityInteraction['id']);
        if (!$entityInteractionEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityInteraction");
        }
        else {
            $entityInteractionMapper = new entityInteractionMapper();
            $entityInteractionMapper->entityInteractionData($entityInteraction,$entityInteractionEntity,$this->entityManager);
            $this->entityManager->flush();
            return $entityInteractionEntity;
        }
    }
    public function delete($id)
    {
        $interaction=$this->entityManager->getRepository(EntityInteractionEntity::class)->find($id);
        $this->entityManager->remove($interaction);
        $this->entityManager->flush();
    }
    public function getEntityInteraction($request)
    {
        $entityInteraction = json_decode($request->getContent(),true);
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)->getInteraction($entityInteraction['entity']
            ,$entityInteraction['id'],$entityInteraction['interaction']);
    }

    public function getClientInteraction($request)
    {
        $entityInteraction = json_decode($request->getContent(),true);
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)->getClientInteraction($entityInteraction['client']);
    }
    public function getAll()
    {
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)->getAll();
    }
}