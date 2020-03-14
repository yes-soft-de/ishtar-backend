<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderDetailsEntityRepository")
 */
class OrderDetailsEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="integer")
     */
    private $rowId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntity()
    {
        return $this->entity->getName();
    }

    public function setEntity(?Entity $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getRowId(): ?int
    {
        return $this->rowId;
    }

    public function setRowId(int $rowId): self
    {
        $this->rowId = $rowId;

        return $this;
    }

    public function getOrder()
    {
        return $this->order->getId();
    }

    public function setOrder(?OrderEntity $order): self
    {
        $this->relation = $order;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
