<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\painting")
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\artistEntity")
     * @ORM\JoinColumn(nullable=false)
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

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaintingId(): ?painting
    {
        return $this->painting_id;
    }

    public function setPaintingId(?painting $painting_id): self
    {
        $this->painting_id = $painting_id;

        return $this;
    }

    public function getArtistId(): ?artistEntity
    {
        return $this->artist_id;
    }

    public function setArtistId(?artistEntity $artist_id): self
    {
        $this->artist_id = $artist_id;

        return $this;
    }
}
