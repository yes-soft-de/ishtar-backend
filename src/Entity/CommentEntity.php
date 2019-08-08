<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\clientEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client_id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $page_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $row_num;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_update;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?clientEntity
    {
        return $this->client_id;
    }

    public function setClientId(?clientEntity $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getPageName(): ?string
    {
        return $this->page_name;
    }

    public function setPageName(string $page_name): self
    {
        $this->page_name = $page_name;

        return $this;
    }

    public function getRowNum(): ?int
    {
        return $this->row_num;
    }

    public function setRowNum(int $row_num): self
    {
        $this->row_num = $row_num;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->last_update;
    }

    public function setLastUpdate(?\DateTimeInterface $last_update): self
    {
        $this->last_update = $last_update;

        return $this;
    }
}
