<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentEntityRepository")
 */
class CommentEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClientEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;


    /**
     * @ORM\Column(type="integer")
     */
    private $row;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"},nullable=true)
     *
     */
    private $date;

    /**
     * @ORM\Column(type="datetime",nullable=true,options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastEdit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $spacial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient():int
    {
        return $this->client->getId();
    }

    public function setClient(?ClientEntity $client): self
    {
        $this->client = $client;

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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDate(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public function setDate(): self
    {
        $this->date = new \DateTime('Now');

        return $this;
    }

    public function getLastEdit(): ?string
    {
        return $this->lastEdit;
    }

    public function setLastEdit(\DateTimeInterface $lastEdit): self
    {
        $this->lastEdit = $lastEdit;

        return $this;
    }

    public function getEntity(): ?int
    {
        return $this->entity->getId();
    }

    public function setEntity(Entity $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getSpacial(): ?bool
    {
        return $this->spacial;
    }

    public function setSpacial(bool $spacial): self
    {
        $this->spacial = $spacial;

        return $this;
    }
}
