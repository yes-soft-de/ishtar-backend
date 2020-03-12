<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateOrderRequest;
use App\Request\UpdateOrderStateRequest;
use App\Service\OrderService;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseController
{
    private $orderService;
    private $autoMapping;
    private $paymentController;
    private $mailer;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService, AutoMapping $autoMapping,PaymentController $paymentController
    ,MailerInterface $mailer)
    {
        $this->orderService = $orderService;
        $this->autoMapping = $autoMapping;
        $this->paymentController=$paymentController;
        $this->mailer=$mailer;
    }

    /**
     * @Route("/orders",name="createOrder",methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request = $this->autoMapping->map(\stdClass::class, CreateOrderRequest::class, (object)$data);
        //get paymentID and redirect to paypal using approved url
        $payment= $this->paymentController->paypal($data);
        $paymentId=$payment->getId();
        $request->setPaymentId($paymentId);
        $result = $this->orderService->create($request);
        $result->setRedirectUrl($payment->getApprovalLink());
        return $this->response($result, self::CREATE);
    }

    /**
     *  @Route("/successorder",name="successOrder")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    //if client confirm payment in paypal website then paypal return to here
    public function ApprovedOrder(Request $request)
    {
         $payerId=$request->get('PayerID');
         $paymentId=$request->get('paymentId');
        if (empty($paymentId) || empty($payerId)) {
            throw new Exception('The response is missing the paymentId or PayerID');
        }
        $request=new ByIdRequest($paymentId);
        //paymentID used to know which order is confirmed;
        $order=$this->orderService->getOrderByPayment($request);
        //change order state to (onProccessing)
        $stateRequest=new UpdateOrderStateRequest($order->getId(),"OnProccessing");
        $stateRequest->setPayerId($payerId);
        $result=$this->orderService->setOrderState($stateRequest);

        //send emails to admins
        $this->sendEmail('HammamZarefa@gmail.com',$order->getId());

        return $this->response($result, self::CREATE);
    }
    /**
     *  @Route("/canceledorder",name="canceledOrder")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function canceledOrder(Request $request)
    {
        $paymentId = $request->get('paymentId');
        if (empty($paymentId))
            {
            throw new Exception('The response is missing the paymentId');
            }
        $request = new ByIdRequest($paymentId);
        $order=$this->orderService->getOrderByPayment($request);
        $stateRequest=new UpdateOrderStateRequest($order->getId(),"Canceled");
        $result=$this->orderService->setOrderState($stateRequest);
        return $this->response($result, self::CREATE);

    }
    /**
     *  @Route("/orders",name="getAllOrders",methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function getAll()
    {
        $result = $this->orderService->getAll();
        return $this->response($result, self::FETCH);
    }
    public function sendEmail($address,$order)
    {
        $email = (new TemplatedEmail())
            ->from(Address::fromString('Ishtar <info@ishtar-art.de>'))
            ->to($address)
            ->subject('New Order')
            ->htmlTemplate('Emails/AdminEmail.html.twig')
            ->context(
                ['orderID' => $order]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
    /**
     *  @Route("/completeorder",name="completeorder",methods={"PUT"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function completeOrder(Request $request)
    {
        $orderId=$request->get('id');
        $request =new UpdateOrderStateRequest($orderId,"completed");
        return $this->orderService->setOrderState($request);

    }

}
