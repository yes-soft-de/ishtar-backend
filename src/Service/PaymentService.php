<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\PaymentEntity;
use App\Manager\PaymentManager;
use App\Request\ByIdRequest;
use App\Request\UpdateOrderStateRequest;
use App\Request\UpdatePaymentRequest;
use App\Response\GetPaymentResponse;
use App\Response\UpdatePaymentResponse;
use Exception;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PaymentService
{
    private $orderService;
    private $paymentManager;
    private $autoMapping;
    /**
     * PaymentService constructor.
     * @param $orderService
     */
    public function __construct(OrderService $orderService,PaymentManager $paymentManager,AutoMapping $autoMapping)
    {
        $this->orderService = $orderService;
        $this->paymentManager=$paymentManager;
        $this->autoMapping=$autoMapping;
    }
    public function create($request)
    {
        $result=$this->paymentManager->create($request);
        return $result;
    }

    public function executeOrder($orderId,$api)
    {
        $result=$this->getByOrder(New ByIdRequest($orderId));
        $paymentId =$result->getPaymentId();
        $payerId=$result->getPayerId();
        $payment = Payment::get($paymentId, $api);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        $request=$this->autoMapping->map(GetPaymentResponse::class,UpdatePaymentRequest::class,$result);
        try {
            // Take the payment
            $payment->execute($execution, $api);
            try {
                $payment = Payment::get($paymentId, $api);
                $request->setPaymentState($payment->getState());
                $request->setTransaction($payment->getTransactions());
            } catch (Exception $e) {
                // Failed to retrieve payment from PayPal
                throw new Exception('Failed to retrieve payment from PayPal'. $e);
            }
        } catch (Exception $e) {
            // Failed to take payment
           // throw new Exception('Failed to take Payment'. $e);
        }
        $result=$this->orderService->setItemsAsSold(new ByIdRequest($orderId));
        $this->orderService->setOrderState(new UpdateOrderStateRequest($orderId,"Completed"));
       // $this->orderService->sendSuccessOrderToClient(New ByIdRequest($orderId));
        $request->setUpdatedDate(new \DateTime('NOW'));
        $response=$this->paymentManager->update($request);
        $response=$this->autoMapping->map(PaymentEntity::class,UpdatePaymentResponse::class,$response);
        return $response;
    }
    public function getByOrder($request)
    {
       $result= $this->paymentManager->getByOrder($request);
       return $this->autoMapping->map(PaymentEntity::class,GetPaymentResponse::class,$result);
    }
    public function setPaymentPayer($request)
    {
        return $this->paymentManager->setPaymentPayer($request);
    }
}