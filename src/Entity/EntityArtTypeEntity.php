<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntityArtTypeEntityRepository")
 */
class EntityArtTypeEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtTypeEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="integer")
     */
    private $row;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtType(): ?int
    {
        return $this->artType->getId();
    }

    public function setArtType(?ArtTypeEntity $artType): self
    {
        $this->artType = $artType;

        return $this;
    }

    public function getEntity(): ?int
    {
        return $this->entity->getId();
    }

    public function setEntity(?Entity $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getRow(): ?int
    {
        return $this->row;
    }

    public function setRow(int $row): self
    {
        $this->row = $row;

        return $this;
    }
}
