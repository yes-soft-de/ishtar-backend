<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistArtTypeEntityRepository")
 */
class ArtistArtTypeEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ArtistEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\OneToOne(targetEntity="ArtTypeEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $artType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?ArtistEntity
    {
        return $this->artist;
    }

    public function setArtist(ArtistEntity $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getArtType(): ?ArtTypeEntity
    {
        return $this->artType;
    }

    public function setArtType(ArtTypeEntity $artType): self
    {
        $this->artType = $artType;

        return $this;
    }
}
