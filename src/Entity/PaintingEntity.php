<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaintingEntityRepository")
 */
class PaintingEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     *   @Groups({"default"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity", inversedBy="painting")
     * @ORM\JoinColumn(nullable=false)
     *   @Groups({"default"})
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity="ArtTypeEntity", inversedBy="painting")
     * @ORM\JoinColumn(nullable=false)
     *   @Groups({"default"})
     */
    private $artType;

    /**
     * @ORM\Column(type="boolean")
     *   @Groups({"default"})
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=45)
     *   @Groups({"default"})
     */
    private $deminsions;

    /**
     * @ORM\Column(type="string", length=45)
     *   @Groups({"default"})
     */
    private $colorsType;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     *   @Groups({"default"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     *   @Groups({"default"})
     */
    private $story;

    /**
     * @ORM\Column(type="datetime")
     *   @Groups({"default"})
     */
    private $addingDate;

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

    public function getArtType(): ?ArtTypeEntity
    {
        return $this->artType;
    }

    public function setArtType(?ArtTypeEntity $artType): self
    {
        $this->artType = $artType;

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

    public function getDeminsions(): ?string
    {
        return $this->deminsions;
    }

    public function setDeminsions(string $deminsions): self
    {
        $this->deminsions = $deminsions;

        return $this;
    }

    public function getColorsType(): ?string
    {
        return $this->colorsType;
    }

    public function setColorsType(string $colorsType): self
    {
        $this->colorsType = $colorsType;

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
        return $this->addingDate;
    }

    public function setAddingDate(\DateTimeInterface $addingDate): self
    {
        $this->addingDate = $addingDate;

        return $this;
    }
}
