<?php

namespace App\Controller;

use App\Request\CreateOrderRequest;
use App\Request\CreatePaymentRequest;
use App\Service\OrderService;
use App\Service\PaymentService;
use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class PaymentController extends BaseController
{
    private $orderService;
    private $paymentService;

    /**
     * PaymentController constructor.
     * @param $orderService
     */
    public function __construct(OrderService $orderService,PaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService=$paymentService;
    }

    /**
     * @Route("/paypal",name="paypal")
     * @throws Exception
     */
    public function paypal(CreateOrderRequest $request)
    {
        $tax=$request->getTax();
        $subtotal=$request->getSubtotal();
        $total=$request->getTotal();
        $api=$this->config();
        $payer=new Payer();
        $details=new Details();
        $amount=new Amount();
        $transaction=new Transaction();
        $payment= new Payment();
        $redirectUrls=new RedirectUrls();
        $payer->setPaymentMethod('paypal');
        $details->setShipping(0.00)
            ->setTax($tax)
            ->setSubtotal($subtotal);
        $amount->setCurrency('EUR')
            ->setTotal($total)
            ->setDetails($details);
        $transaction->setAmount($amount)
            ->setDescription('Membership');
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction]);
        $redirectUrls->setReturnUrl('https://ishtar-art.de/successorder')
            ->setCancelUrl('https://ishtar-art.de/canceledorder');
        $payment->setRedirectUrls($redirectUrls);

    try {
        $payment->create($api);
    }

    catch (\Exception $exception)
        {
            throw new Exception('unable to create payment link.'. $exception);
        }
        $paymentRequest=new CreatePaymentRequest();
        $paymentRequest->setOrder($request->getId());
        $paymentRequest->setToken($payment->getToken());
        $paymentRequest->setPayment($payment->getId());
        $paymentRequest->setPaymentState($payment->getState());
        $paymentRequest->setPaymentAmount($total);
        $result=$this->paymentService->create($paymentRequest);

    return $payment;
       // return $this->redirect($redirectUrl,302);
    }

    /**
     * @Route("/executeorder/{id}", name="paymentSuccess")
     * @throws Exception
     */
    public function executeOrder(Request $request)
    {
        $orderId=$request->get('id');
        $api=$this->config();
       $result=$this->paymentService->executeOrder($orderId,$api);
       return $this->response($result,self::UPDATE);
    }
    public function cancelled()
    {

    }
    public function config()
    {
        require __DIR__ . '\..\..\vendor\autoload.php';
        $api=new ApiContext(
            new OAuthTokenCredential(
                'AXm8G6c5dNah_FIppxwVuet5ex15guMif70-dFjrF-hjsTiEd5ueLGvVX8RPWDESiB0o91Uva3IySiD5'
                ,'EHDZeRu7iU-FoBlAWbTZtvCPGLIQEJLCcL3StebDuFQ9gRbn5169pPdg7YaVbRAxbYAJ3K6WExktlvOm'));
        $api->setConfig([
            'mode'=>'sandbox',
            'http.ConnectionTimeOut'=>30,
            'log.logEnable'=>'true',
            'log.FileName'=>'log.text',
            'log.LogLevel'=>'DEBUG',
            'valdiation.level'=>'log'
        ]);
        return $api;
    }
}
