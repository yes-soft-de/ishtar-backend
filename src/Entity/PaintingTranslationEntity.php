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
}
