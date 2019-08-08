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
     * @ORM\ManyToOne(targetEntity="App\Entity\artistEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\arttypeEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $art_type_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArtTypeId(): ?arttypeEntity
    {
        return $this->art_type_id;
    }

    public function setArtTypeId(?arttypeEntity $art_type_id): self
    {
        $this->art_type_id = $art_type_id;

        return $this;
    }
}
