<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PantingImageEntityRepository")
 */
class PantingImageEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PaintingEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity")
     */
    private $artist_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaintingId(): ?PaintingEntity
    {
        return $this->painting_id;
    }

    public function setPaintingId(?PaintingEntity $painting_id): self
    {
        $this->painting_id = $painting_id;

        return $this;
    }

    public function getArtistId(): ?ArtistEntity
    {
        return $this->artist_id;
    }

    public function setArtistId(?ArtistEntity $artist_id): self
    {
        $this->artist_id = $artist_id;

        return $this;
    }
}
