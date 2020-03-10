<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\OrderEntity;
use App\Repository\OrderEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateOrderRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateOrderStateRequest;
use App\Request\UpdateStateRequest;
use App\Request\UpdateStatueRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class OrderManager
{
    private $entityManager;
    private $orderRepository;
    private $autoMapping;
    private $clientManager;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                OrderEntityRepository $orderEntityRepository, AutoMapping $autoMapping
        ,ClientManager $clientManager)
    {
        $this->entityManager = $entityManagerInterface;
        $this->orderRepository = $orderEntityRepository;
        $this->autoMapping = $autoMapping;
        $this->clientManager=$clientManager;
    }

    public function create(CreateOrderRequest $request)
    {
        $request->setClient($this->clientManager->getClient($request->getClient()));
        $orderEntity = $this->autoMapping->map(CreateOrderRequest::class, OrderEntity::class, $request);
        $orderEntity->setAddingDate()
            ->setOrderState("created")
            ->setShippingState(0);
        $this->entityManager->persist($orderEntity);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return $orderEntity;
    }

    public function setOrderState(UpdateOrderStateRequest $request)
    {
        $orderEntity=$this->orderRepository->find($request->getId());
        $orderEntity->setOrderState($request->getState());
        $orderEntity->setPayerId($request->getPayerId());
        $this->entityManager->flush();
        return $orderEntity;
    }
    public function getOrderByPayment(ByIdRequest $request)
    {
        return $this->orderRepository->findOrderByPayment($request->getId());
    }

    public function getAll()
    {
        return $this->orderRepository->findAll();
    }
    public function getOrderByid(ByIdRequest $request)
    {
        return $this->orderRepository->find($request->getId());
    }

}