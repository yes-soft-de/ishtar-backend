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
     * @ORM\ManyToOne(targetEntity="App\Entity\paintingEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting_id;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=5)
     */
    private $start_price;



    /**
     * @ORM\Column(type="decimal", precision=8, scale=5)
     */
    private $final_price;

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

    public function getStartPrice()
    {
        return $this->start_price;
    }

    public function setStartPrice($start_price): self
    {
        $this->start_price = $start_price;

        return $this;
    }



    public function getFinalPrice()
    {
        return $this->final_price;
    }

    public function setFinalPrice($final_price): self
    {
        $this->final_price = $final_price;

        return $this;
    }
}
