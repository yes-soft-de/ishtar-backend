<?php


namespace App\Response;


class UpdatePaymentResponse
{
    private $id;
    private $order;
    private $paymentId;
    private $payerId;
    private $transaction;
    private $paymentAmount;
    private $paymentState;
    private $invoice;
    private $token;
    private $createdDate;
    private $updatedDate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order->getId();
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order): void
    {
        $this->order = $order;
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

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction[0]->getItemList();
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction($transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * @param mixed $paymentAmount
     */
    public function setPaymentAmount($paymentAmount): void
    {
        $this->paymentAmount = $paymentAmount;
    }

    /**
     * @return mixed
     */
    public function getPaymentState()
    {
        return $this->paymentState;
    }

    /**
     * @param mixed $paymentState
     */
    public function setPaymentState($paymentState): void
    {
        $this->paymentState = $paymentState;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        if(isset($this->createdDate))
            return $this->createdDate->Format('d-m-Y H:i');
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getUpdatedDate()
    {
        if(isset($this->updatedDate))
            return $this->updatedDate->Format('d-m-Y H:i');
    }

    /**
     * @param mixed $updatedDate
     */
    public function setUpdatedDate($updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

}