<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialMediaArtistEntityRepository")
 */
class SocialMediaArtistEntity
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
     * @ORM\OneToOne(targetEntity="App\Entity\SocialMediaEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $socialMedia;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $address;

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

    public function getSocialMedia(): ?SocialMediaEntity
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(SocialMediaEntity $socialMedia): self
    {
        $this->socialMedia = $socialMedia;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
