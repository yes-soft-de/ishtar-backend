<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\PaymentEntity;
use App\Repository\OrderEntityRepository;
use App\Repository\PaymentEntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreatePaymentRequest;
use App\Request\UpdatePaymentPayerRequest;
use App\Request\UpdatePaymentRequest;
use Doctrine\ORM\EntityManagerInterface;

class PaymentManager
{
    private $entityManager;
    private $paymentRepository;
    private $autoMapping;
    private $orderRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                PaymentEntityRepository $paymentRepository, AutoMapping $autoMapping,
                                OrderEntityRepository $orderRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->paymentRepository = $paymentRepository;
        $this->autoMapping = $autoMapping;
        $this->orderRepository=$orderRepository;
    }

    public function create(CreatePaymentRequest $request)
    {
        $request->setOrder($this->orderRepository->find($request->getOrder()));
        $paymentEntity = $this->autoMapping->map(CreatePaymentRequest::class, PaymentEntity::class, $request);
        $paymentEntity->setCreatedDate();
        $this->entityManager->persist($paymentEntity);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return $paymentEntity;
    }
    public function getByPayment(ByIdRequest $request)
    {
        return $this->paymentRepository->getByPaymentId($request->getId());
    }
    public function getByOrder(ByIdRequest $request)
    {
        return $this->paymentRepository->getByOrder($request->getId());
    }
    public function setPaymentPayer(UpdatePaymentPayerRequest $request)
    {
        $payment=$this->paymentRepository->getByPaymentId($request->getPaymentId());
        $payment->setPayerId($request->getPayerId());
        $this->entityManager->flush();
        return $payment;
    }
    public function update(UpdatePaymentRequest $request)
    {
        $paymentEntity=$this->paymentRepository->getByPaymentId($request->getPaymentId());
        $payment= $this->autoMapping->mapToObject(UpdatePaymentRequest::class, PaymentEntity::class, $request,$paymentEntity);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return $payment;
    }
    public function getByToken(ByIdRequest $request)
    {
        return $this->paymentRepository->getByToken($request->getId());
    }
}