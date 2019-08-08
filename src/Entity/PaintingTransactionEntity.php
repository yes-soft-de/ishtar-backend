<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaintingTransactionEntityRepository")
 */
class PaintingTransactionEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\paintingEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\clientEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=5)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaintingId(): ?paintingEntity
    {
        return $this->painting_id;
    }

    public function setPaintingId(?paintingEntity $painting_id): self
    {
        $this->painting_id = $painting_id;

        return $this;
    }

    public function getClientId(): ?clientEntity
    {
        return $this->client_id;
    }

    public function setClientId(?clientEntity $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }
}
