<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryEntityRepository")
 */
class GalleryEntity
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
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity", inversedBy="gallery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PaintingEntity", mappedBy="gallery")
     */
    private $paintingEntities;

    public function __construct()
    {
        $this->paintingEntities = new ArrayCollection();
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

    public function getArtist(): ?ArtistEntity
    {
        return $this->artist;
    }

    public function setArtist(?ArtistEntity $artist): self
    {
        $this->artist = $artist;

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

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection|PaintingEntity[]
     */
    public function getPaintingEntities(): Collection
    {
        return $this->paintingEntities;
    }

    public function addPaintingEntity(PaintingEntity $paintingEntity): self
    {
        if (!$this->paintingEntities->contains($paintingEntity)) {
            $this->paintingEntities[] = $paintingEntity;
            $paintingEntity->setGallery($this);
        }

        return $this;
    }

    public function removePaintingEntity(PaintingEntity $paintingEntity): self
    {
        if ($this->paintingEntities->contains($paintingEntity)) {
            $this->paintingEntities->removeElement($paintingEntity);
            // set the owning side to null (unless already changed)
            if ($paintingEntity->getGallery() === $this) {
                $paintingEntity->setGallery(null);
            }
        }

        return $this;
    }
}
