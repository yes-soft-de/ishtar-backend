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
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $finalPrice;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AuctionEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $auction;

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
}
