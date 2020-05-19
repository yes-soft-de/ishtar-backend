<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\OrderDetailsEntity;
use App\Entity\OrderEntity;
use App\Repository\EntityRepository;
use App\Repository\OrderDetailsEntityRepository;
use App\Repository\OrderEntityRepository;
use App\Request\AddOrderItemsRequest;
use App\Request\ByIdRequest;
use App\Request\CreateOrderRequest;
use App\Request\UpdateStateRequest;
use Doctrine\ORM\EntityManagerInterface;

class OrderDetailsManager
{

    private $entityManager;
    private $orderRepository;
    private $autoMapping;
    private $entityRepository;
    private $paintingManager;
    private $orderDetailsRepository;
    public function __construct(EntityManagerInterface $entityManagerInterface,
                                OrderEntityRepository $orderEntityRepository, AutoMapping $autoMapping
    ,EntityRepository $entityRepository,PaintingManager $paintingManager,
                                OrderDetailsEntityRepository $orderDetailsRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->orderRepository = $orderEntityRepository;
        $this->autoMapping = $autoMapping;
        $this->entityRepository=$entityRepository;
        $this->paintingManager=$paintingManager;
        $this->orderDetailsRepository=$orderDetailsRepository;
    }
    //insert order items in orderDetails Table
    public function addItems(CreateOrderRequest $request,$orderId)
    {
        $items=[];
        $orderItems=$request->getItems();
        $counter=0;
        foreach ($orderItems as $item)
          {
              //maping items(like painting) to insert in orderDetails Table
           $items[]=$this->autoMapping->map('array',AddOrderItemsRequest::class,$item);
           $items[$counter]->setOrder($this->orderRepository->find($orderId));
           $items[$counter]->setEntity($this->entityRepository->find($items[$counter]->getEntity()));
           $itemsEntity[] = $this->autoMapping->map(AddOrderItemsRequest::class, OrderDetailsEntity::class,
               $items[$counter]);
           $this->entityManager->persist($itemsEntity[$counter]);
           $this->entityManager->flush();
           $this->entityManager->clear();
           $counter++;
             }
        return $itemsEntity;
    }
    public function updateItemsState($orderItems,$state)
    {
        //change painting state to (inOrder)
        // if another products type is avliable, we must change state here b calling updateState function
        foreach ($orderItems as $item)
            if ($item['entity']==1)
            {
                $paintingState=new UpdateStateRequest($item['rowId'],$state);
                $this->paintingManager->updatePaintingState($paintingState);
            }
        return $orderItems;
    }
    public function getOrderItems(ByIdRequest $request)
    {
        return $this->orderDetailsRepository->getOrderItems($request->getId());
    }
}