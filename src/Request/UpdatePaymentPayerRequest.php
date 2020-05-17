<?php


namespace App\Request;


class UpdatePaymentPayerRequest
{
    private $paymentId;
    private $payerId;

    /**
     * UpdatePaymentPayerRequest constructor.
     * @param $paymentId
     * @param $payerId
     */
    public function __construct($paymentId, $payerId)
    {
        $this->paymentId = $paymentId;
        $this->payerId = $payerId;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param mixed $paymentId
     */
    public function setPaymentId($paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return mixed
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * @param mixed $payerId
     */
    public function setPayerId($payerId): void
    {
        $this->payerId = $payerId;
    }


}