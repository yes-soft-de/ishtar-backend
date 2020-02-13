<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\EntityInteractionEntity;
use App\Repository\ClientEntityRepository;
use App\Repository\EntityInteractionEntityRepository;
use App\Repository\EntityRepository;
use App\Repository\InteractionEntityRepository;
use App\Request\CreateInteractionRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetInterctionEntityRequest;
use App\Request\UpdateInteractionRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;

class EntityInteractionManager
{
    private $entityManager;
    private $entityInteractionRepository;
    private $entityRepository;
    private $clientRepository;
    private $interactionRepository;
    public $autoMapping;

    public function __construct(EntityManagerInterface $entityManagerInterface, InteractionEntityRepository $interactionRepository,
                                EntityInteractionEntityRepository $entityInteractionEntityRepository,
                                EntityRepository $entityRepository, ClientEntityRepository $clientRepository,
                                AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityInteractionRepository = $entityInteractionEntityRepository;
        $this->entityRepository = $entityRepository;
        $this->clientRepository = $clientRepository;
        $this->interactionRepository = $interactionRepository;
        $this->autoMapping = $autoMapping;
    }

    public function create(CreateInteractionRequest $request)
    {
        //we dont want client if reaction is view
        if ($request->getInteraction() != 3)
        {
            $request->setClient($this->clientRepository->find($request->getClient()));
        }

        $request->setEntity($this->entityRepository->find($request->getEntity()));
        $request->setInteraction($this->interactionRepository->find($request->getInteraction()));
        $entityInteractionData = $this->autoMapping->map(CreateInteractionRequest::class,
            EntityInteractionEntity::class, $request);
        $entityInteractionData->setDate(new \DateTime('now'));
        $this->entityManager->persist($entityInteractionData);
        $this->entityManager->flush();

        return $entityInteractionData;
    }

    public function update(UpdateInteractionRequest $request)
    {
        $entityInteractionEntity = $this->entityInteractionRepository->find($request->getId());
        if (!$entityInteractionEntity) {
            $exception = new EntityException();
            $exception->entityNotFound("entityInteraction");
        } else {
            $request->setClient($this->clientRepository->find($request->getClient()));
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $request->setInteraction($this->interactionRepository->find($request->getInteraction()));
            $entityInteractionEntity = $this->autoMapping->mapToObject(UpdateInteractionRequest::class,
                EntityInteractionEntity::class, $request, $entityInteractionEntity);
            $this->entityManager->flush();
            return $entityInteractionEntity;
        }
    }

    public function delete(DeleteRequest $request)
    {
        $interaction = $this->entityInteractionRepository->find($request->getId());
        if (!$interaction) {
            $exception = new EntityException();
            $exception->entityNotFound("interaction");
        } else {
            $this->entityManager->remove($interaction);
            $this->entityManager->flush();
        }
        return $interaction;
    }

    public function getEntityInteraction(GetInterctionEntityRequest $request)
    {
        return $entityInteractionResult = $this->entityInteractionRepository
            ->getInteraction($request->getEntity(), $request->getRow(), $request->getInteraction());
    }

    public function getClientInteraction(GetClientRequest $request)
    {
        return $entityInteractionResult = $this->entityInteractionRepository
            ->getClientInteraction($request->getClient());
    }

    public function getAll()
    {
        return $entityInteractionResult = $this->entityInteractionRepository->getAll();
    }

    public function getMostViews()
    {
        return $MostViews = $this->entityInteractionRepository->getMostViews();
    }

    public function getInteractions(GetInterctionEntityRequest $request)
    {
        return $interaction = $this->entityInteractionRepository->getInteraction($request->getEntity(),
            $request->getRow(), $request->getInteraction());
    }

    public function getClientFollows($client)
    {
        return $this->entityInteractionRepository->getClientFollows($client);
    }
}