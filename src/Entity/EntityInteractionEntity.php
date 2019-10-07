<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntityInteractionEntityRepository")
 */
class EntityInteractionEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InteractionEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $interaction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="integer")
     */
    private $row;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClientEntity")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInteraction(): ?InteractionEntity
    {
        return $this->interaction;
    }

    public function setInteraction(?InteractionEntity $interaction): self
    {
        $this->interaction = $interaction;

        return $this;
    }

    public function getEntity(): ?Entity
    {
        return $this->entity;
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

    public function getClient(): ?ClientEntity
    {
        return $this->client;
    }

    public function setClient(?ClientEntity $client): self
    {
        $this->client = $client;

        return $this;
    }
}
