<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentEntityRepository")
 */
class PaymentEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paymentId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $payerId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\OrderEntity", cascade={"persist", "remove"})
     */
    private $order;

    /**
     * @ORM\Column(type="json_array",nullable=true)
     */
    private $transaction;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $paymentAmount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentState;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function setPaymentId(string $paymentId): self
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    public function getPayerId(): ?string
    {
        return $this->payerId;
    }

    public function setPayerId(string $payerId): self
    {
        $this->payerId = $payerId;

        return $this;
    }

    public function getOrder(): ?OrderEntity
    {
        return $this->order;
    }

    public function setOrder(?OrderEntity $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getTransaction(): ?array
    {
        return $this->transaction;
    }

    public function setTransaction(?array $transaction): self
    {
        $this->transaction = $transaction;

        return $this;
    }

    public function getPaymentAmount(): ?string
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(?string $paymentAmount): self
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    public function getPaymentState(): ?string
    {
        return $this->paymentState;
    }

    public function setPaymentState(?string $paymentState): self
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(): self
    {
        $this->createdDate = new \DateTime('NOW');

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(?\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
