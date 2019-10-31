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
        $entityInteractionEntity=$this->entityManager->getRepository(EntityInteractionEntity::class)->find($request->get('id'));
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
    public function delete(Request $request)
    {
        $interaction=$this->entityManager->getRepository(EntityInteractionEntity::class)->find($request->get('id'));
        $this->entityManager->remove($interaction);
        $this->entityManager->flush();
        return $interaction;
    }
    public function getEntityInteraction(Request $request)
    {
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)
            ->getInteraction($request->get('entity'),$request->get('row'),$request->get('interaction'));
    }

    public function getClientInteraction(Request $request)
    {
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)
            ->getClientInteraction($request->get('client'));
    }
    public function getAll()
    {
        return $entityInteractionResult =$this->entityManager->getRepository(EntityInteractionEntity::class)->getAll();
    }
}