<?php


namespace App\Service;


use App\Request\ByIdRequest;
use App\Request\UpdateOrderStateRequest;
use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    private $orderService;

    /**
     * PaymentService constructor.
     * @param $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function executeOrder($orderId,$api)
    {
        $order=$this->orderService->getOrderById(new ByIdRequest($orderId));
        $paymentId =$order->getPaymentId();
        $payerId=$order->getPayerId();
        $payment = Payment::get($paymentId, $api);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);


        try {
            // Take the payment
            $payment->execute($execution, $api);

            try {
                $payment = Payment::get($paymentId, $api);

                $data = [
                    'transaction_id' => $payment->getId(),
                    'payment_amount' => $payment->transactions[0]->amount->total,
                    'payment_status' => $payment->getState(),
                    'invoice_id' => $payment->transactions[0]->invoice_number
                ];

            } catch (Exception $e) {
                // Failed to retrieve payment from PayPal
                throw new Exception('Failed to retrieve payment from PayPal'. $e);

            }

        } catch (Exception $e) {
            // Failed to take payment
           // throw new Exception('Failed to take Payment'. $e);
        }
        $result=$this->orderService->setItemsAsSold(new ByIdRequest($orderId));
        $this->orderService->setOrderState(new UpdateOrderStateRequest($orderId,"completed"));
        $this->orderService->sendSuccessOrderToClient(New ByIdRequest($orderId));

        return new Response("Completed",200);
    }

}