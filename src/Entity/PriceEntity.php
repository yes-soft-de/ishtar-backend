<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceEntityRepository")
 */
class PriceEntity
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
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $row;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntity(): ?int
    {
        return $this->entity->getId();
    }

    public function setEntity(?Entity $entity): self
    {
        $this->entity = $entity;

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

    public function getCreatedDate(): ?string
    {
        return $this->createdDate->format('Y-m-d H:i:s');
    }

    public function setCreatedDate(): self
    {
        $this->createdDate =$this->createDate = new \DateTime('Now');;

        return $this;
    }

    public function getRow(): ?int
    {
        return $this->row;
    }

    public function setRow(int $row): self
    {
        $this->row = $row;

        return $this;
    }
}
