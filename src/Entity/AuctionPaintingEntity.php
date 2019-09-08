<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuctionPaintingEntityRepository")
 */
class AuctionPaintingEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PaintingEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $startPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $finalPrice;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AuctionEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $auction;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $highiestPrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClientEntity")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPainting(): ?PaintingEntity
    {
        return $this->painting;
    }

    public function setPainting(PaintingEntity $painting): self
    {
        $this->painting = $painting;

        return $this;
    }

    public function getStartPrice()
    {
        return $this->startPrice;
    }

    public function setStartPrice($startPrice): self
    {
        $this->startPrice = $startPrice;

        return $this;
    }

    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    public function setFinalPrice($finalPrice): self
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }

    public function getAuction(): ?AuctionEntity
    {
        return $this->auction;
    }

    public function setAuction(AuctionEntity $auction): self
    {
        $this->auction = $auction;

        return $this;
    }

    public function getHighiestPrice(): ?string
    {
        return $this->highiestPrice;
    }

    public function setHighiestPrice(?string $highiestPrice): self
    {
        $this->highiestPrice = $highiestPrice;

        return $this;
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
}
