<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 */
class ReportEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtistEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\Column(type="integer")
     */
    private $emailId;

    /**
     * @ORM\Column(type="date")
     */
    private $sendingDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="json")
     */
    private $emailData = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmailId(): ?int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): self
    {
        $this->emailId = $emailId;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sendingDate;
    }

    public function setSendingDate(\DateTimeInterface $sendingDate): self
    {
        $this->sendingDate = $sendingDate;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmailData(): ?array
    {
        return $this->emailData;
    }

    public function setEmailData(array $emailData): self
    {
        $this->emailData = $emailData;

        return $this;
    }
}
