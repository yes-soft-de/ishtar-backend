<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaintingTranslationEntityRepository")
 */
class PaintingTranslationEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $originID;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

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
     * @ORM\Column(type="string", length=10)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $keyWords;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $artType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colorsType;

    /**
     * @ORM\Column(type="text")
     */
    private $story;

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate): self
    {
        $this->createDate = new \DateTime('Now');;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdetedBy()
    {
        return $this->updetedBy;
    }

    public function setUpdetedBy($updetedBy): self
    {
        $this->updetedBy = $updetedBy;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }


    public function setUpdateDate(): self
    {
        $this->updateDate = $this->createDate = new \DateTime('Now');

        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginID(): ?int
    {
        return $this->originID;
    }

    public function setOriginID(int $originID): self
    {
        $this->originID = $originID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getKeyWords(): ?string
    {
        return $this->keyWords;
    }

    public function setKeyWords(?string $keyWords): self
    {
        $this->keyWords = $keyWords;

        return $this;
    }

    public function getArtType(): ?string
    {
        return $this->artType;
    }

    public function setArtType(string $artType): self
    {
        $this->artType = $artType;

        return $this;
    }

    public function getColorsType(): ?string
    {
        return $this->colorsType;
    }

    public function setColorsType(?string $colorsType): self
    {
        $this->colorsType = $colorsType;

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
}
