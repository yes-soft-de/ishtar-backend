<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\OrderEntity;
use App\Manager\OrderDetailsManager;
use App\Manager\OrderManager;
use App\Request\ByIdRequest;
use App\Response\CreateOrderResponse;
use App\Response\GetOrderResponse;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class OrderService
{
    private $autoMapping;
    private $orderDetailsManager;
    private $paintingService;
    private $clientService;
    private $mailer;


    public function __construct(OrderManager $orderManager,AutoMapping $autoMapping,
                                OrderDetailsManager $orderDetailsManager,PaintingService $paintingService,
                                ClientService $clientService,MailerInterface $mailer)
    {
        $this->orderManager=$orderManager;
        $this->autoMapping=$autoMapping;
        $this->orderDetailsManager=$orderDetailsManager;
        $this->paintingService=$paintingService;
        $this->clientService=$clientService;
        $this->mailer=$mailer;
    }

    public function create($request)
    {
        $orderResult =$this->orderManager->create($request);
        $orderID=$orderResult->getId();
        $orderDetails=$this->orderDetailsManager->addItems($request,$orderID);
        $response=$this->autoMapping->map(OrderEntity::class,CreateOrderResponse::class,$orderResult);
        $response->setItems($orderDetails);
        return $response;
    }

    public function getOrderByPayment($request)
    {
        $order=$this->orderManager->getOrderByPayment($request);
        return $order;
    }
    public function setOrderState($request)
    {
        $result= $this->orderManager->setOrderState($request);
        $order=$this->autoMapping->map(OrderEntity::class,GetOrderResponse::class,$result);
        return $order;
    }
    public function getAll()
    {
        $orders=$this->orderManager->getAll();
        $response=[];
        foreach ($orders as $order)
        {
           $response[]=$this->autoMapping->map(OrderEntity::class,GetOrderResponse::class,$order);
        }
        return $response;
    }
    public function getOrderById($request)
    {
        $order=$this->orderManager->getOrderByid($request);
        $response=$this->autoMapping->map(OrderEntity::class,GetOrderResponse::class,$order);
        return $response;
    }
    public function updateItemsState($request,$state)
    {
        $items= $this->orderDetailsManager->getOrderItems($request);
       return  $this->orderDetailsManager->updateItemsState((array)$items,$state);
    }
    public function setItemsAsSold($request)
    {
        return $this->updateItemsState($request,0);
    }
    public function setItemsAsInOrder($request)
    {
        return $this->updateItemsState($request,2);
    }
//    public function sendSuccessOrderEmailToArtist(ByIdRequest $request)
//    {
//        $items=$this->orderDetailsManager->getOrderItems($request);
//        foreach ($items as $item)
//        {
//            if($item['entity']==1)
//                $paintings[]=$this->paintingService->getPaintingById($item['rowId']);
//        }
//       foreach ($paintings as $painting)
//       {
//           $artist[]=$painting->getArtistID();
//                foreach ($paintings as $painting)
//
//       }
//    }
    public function sendSuccessOrderToClient(ByIdRequest $request)
    {
        $order = $this->getOrderById($request);
        $client = $order->getClient();
        $clientEmail=($this->clientService->getById(new ByIdRequest($client)))->getEmail();
        $email = (new TemplatedEmail())
            ->from(Address::fromString('Ishtar <info@ishtar-art.de>'))
            ->to($clientEmail)
            ->subject('success order')
            ->htmlTemplate('Emails/ClientOrderEmail.html.twig')
            ->context(
                ['orderID' => $order->getId()]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
    public function getClientOrders($request)
    {
        $orders=$this->orderManager->getClientOtders($request);
        $counter=0;
        $response=[];
        foreach ($orders as $order)
        {
            $response[]=$this->autoMapping->map(OrderEntity::class,GetOrderResponse::class,$order);
            $items= $this->orderDetailsManager->getOrderItems(New ByIdRequest($response[$counter]->getId()));
            $response[$counter]->setItems($items);
            $counter++;
        }
        return  $response;
    }
    public function getOrderByToken($request)
    {
        $order=$this->orderManager->getOrderByToken($request);
        return $order;
    }
}