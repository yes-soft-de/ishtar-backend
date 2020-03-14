<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderEntityRepository")
 */
class OrderEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClientEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryAddress;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $subtotal;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $tax;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $total;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $addingDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatingDate;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $orderState;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $shippingState;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentMethod;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?ClientEntity
    {
        return $this->client;
    }

    public function setClient(?ClientEntity $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function setSubtotal(string $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(?string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getAddingDate()
    {
        return $this->addingDate;
    }

    public function setAddingDate(): self
    {
        $this->addingDate = new \DateTime('NOW');

        return $this;
    }

    public function getUpdatingDate(): ?\DateTimeInterface
    {
        return $this->updatingDate;
    }

    public function setUpdatingDate(?\DateTimeInterface $updatingDate): self
    {
        $this->updatingDate = $updatingDate;

        return $this;
    }

    public function getOrderState(): ?string
    {
        return $this->orderState;
    }

    public function setOrderState(?string $orderState): self
    {
        $this->orderState = $orderState;

        return $this;
    }

    public function getShippingState(): ?bool
    {
        return $this->shippingState;
    }

    public function setShippingState(?bool $shippingState): self
    {
        $this->shippingState = $shippingState;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

}
