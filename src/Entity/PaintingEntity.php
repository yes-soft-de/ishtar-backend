<?php

namespace App\Entity;

use Doctrine\DBAL\Types\SmallIntType;
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
     * @ORM\JoinColumn( onDelete="CASCADE")
     *  @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     *
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity", inversedBy="painting")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     *   @Groups({"default"})
     */
    private $artist;


    /**
     * @ORM\Column(type="smallint")
     *   @Groups({"default"})
     */
    private $state;


    /**
     * @ORM\Column(type="string", length=45)
     *   @Groups({"default"})
     */
    private $colorsType;



    /**
     * @ORM\Column(type="text")
     *   @Groups({"default"})
     */
    private $keyWords;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=0)
     */
    private $height;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=0)
     */
    private $width;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createDate;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $updetedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GalleryEntity", inversedBy="paintingEntities")
      * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $gallery;

    /**
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $signed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFeatured;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbImage;



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

       public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

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

    public function getkeyWords(): ?string
    {
        return $this->keyWords;
    }

    public function setkeyWords(string $keyWords): self
    {
        $this->keyWords = $keyWords;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(): self
    {
        $this->createDate =new \DateTime('Now');;

        return $this;
    }

    public function getUpdetedBy(): ?string
    {
        return $this->updetedBy;
    }

    public function setUpdetedBy(?string $updetedBy): self
    {
        $this->updetedBy = $updetedBy;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(): self
    {
        $this->updateDate = $this->createDate = new \DateTime('Now');

        return $this;
    }

    public function getGallery(): ?int
    {
        return $this->gallery;
    }

    public function setGallery(?GalleryEntity $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    public function getSigned(): ?string
    {
        return $this->signed;
    }

    public function setSigned(?string $signed): self
    {
        $this->signed = $signed;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(?bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getThumbImage(): ?string
    {
        return $this->thumbImage;
    }

    public function setThumbImage(?string $thumbImage): self
    {
        $this->thumbImage = $thumbImage;

        return $this;
    }


}
