<?php


namespace App\Manager;


use App\Entity\EntityInteractionEntity;
use App\Mapper\EntityInteractionMapper;
use App\Repository\ClientEntityRepository;
use App\Repository\EntityInteractionEntityRepository;
use App\Repository\EntityRepository;
use App\Repository\InteractionEntityRepository;
use App\Request\CreateInteractionRequest;
use App\Request\GetClientRequest;
use App\Request\GetInterctionEntityRequest;
use App\Request\UpdateClapRequest;
use App\Request\UpdateInteractionRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityInteractionManager
{
    private $entityManager;
    private $entityInteractionRepository;
    private $entityRepository;
    private $clientRepository;
    private $interactionRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,InteractionEntityRepository $interactionRepository,
                                EntityInteractionEntityRepository $entityInteractionEntityRepository,
                                EntityRepository $entityRepository,ClientEntityRepository $clientRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityInteractionRepository=$entityInteractionEntityRepository;
        $this->entityRepository=$entityRepository;
        $this->clientRepository=$clientRepository;
        $this->interactionRepository=$interactionRepository;
    }

    public function create(CreateInteractionRequest$request)
    {$config = new AutoMapperConfig();
        $config->registerMapping(CreateInteractionRequest::class,
            EntityInteractionEntity::class);
        $mapper = new AutoMapper($config);
        $request->setClient($this->clientRepository->find($request->getClient()));
        $request->setEntity($this->entityRepository->find($request->getEntity()));
        $request->setInteraction($this->interactionRepository->find($request->getInteraction()));
        $entityInteractionData = $mapper->map($request, EntityInteractionEntity::class);
        $this->entityManager->persist($entityInteractionData);
        $this->entityManager->flush();
        return $entityInteractionData;
    }
    public function update(UpdateInteractionRequest $request)
    {
        $entityInteractionEntity=$this->entityInteractionRepository->find($request->getId());
        if (!$entityInteractionEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("entityInteraction");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(UpdateInteractionRequest::class,
                EntityInteractionEntity::class);
            $mapper = new AutoMapper($config);
            $request->setClient($this->clientRepository->find($request->getClient()));
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $request->setInteraction($this->interactionRepository->find($request->getInteraction()));
            $entityInteractionEntity = $mapper->mapToObject($request, $entityInteractionEntity);
            $this->entityManager->flush();
            return $entityInteractionEntity;
        }
    }
    public function delete(Request $request)
    {
        $interaction=$this->entityInteractionRepository->find($request->get('id'));
        if (!$interaction) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $this->entityManager->remove($interaction);
            $this->entityManager->flush();
        }
        return $interaction;
    }
    public function getEntityInteraction(GetInterctionEntityRequest $request)
    {
        return $entityInteractionResult =$this->entityInteractionRepository
            ->getInteraction($request->getEntity(),$request->getRow(),$request->getInteraction());
    }

    public function getClientInteraction(GetClientRequest $request)
    {
        return $entityInteractionResult =$this->entityInteractionRepository
            ->getClientInteraction($request->getClient());
    }
    public function getAll()
    {
        return $entityInteractionResult =$this->entityInteractionRepository->getAll();
    }
    public function getMostViews()
    {
        return $MostViews =$this->entityInteractionRepository->getMostViews();
    }
}