<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistEntityRepository")
 */
class ArtistEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups({"default"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     *  @Groups({"default"})
     * */
    private $name;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $residence;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $story;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $linkedin;



    public function __construct()
    {
        $this->painting = new ArrayCollection();
    }

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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getResidence(): ?string
    {
        return $this->residence;
    }

    public function setResidence(?string $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }


}
