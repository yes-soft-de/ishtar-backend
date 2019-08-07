<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaintingRepository")
 */
class Painting
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity")
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtType")
     */
    private $art_type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $dimensions;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $colors_type;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=6)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $story;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $adding_date;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\artistentity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArtist(): ?ArtistEntity
    {
        return $this->artist;
    }

    public function setArtist(?ArtistEntity $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getArtType(): ?ArtType
    {
        return $this->art_type;
    }

    public function setArtType(?ArtType $art_type): self
    {
        $this->art_type = $art_type;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDimensions(): ?string
    {
        return $this->dimensions;
    }

    public function setDimensions(string $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    public function getColorsType(): ?string
    {
        return $this->colors_type;
    }

    public function setColorsType(?string $colors_type): self
    {
        $this->colors_type = $colors_type;

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

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getAddingDate(): ?\DateTimeInterface
    {
        return $this->adding_date;
    }

    public function setAddingDate(?\DateTimeInterface $adding_date): self
    {
        $this->adding_date = $adding_date;

        return $this;
    }


    public function getRelation(): ?artistentity
    {
        return $this->relation;
    }

    public function setRelation(?artistentity $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
