<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClapEntityRepository")
 */
class ClapEntity
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
     * @ORM\Column(type="integer")
     */
    private $value;

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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
