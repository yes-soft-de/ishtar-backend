<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**

 * @ORM\Entity(repositoryClass="App\Repository\ArtistEntityRepository")
 */
class ArtistEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups({"default"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     *  @Groups({"default"})
     * */
    public $name;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */

    public $nationality;
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    public $residence;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $birthDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $story;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GalleryEntity", mappedBy="artist")
     */
    private $gallery;

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
    private $updatedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Instagram;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;



//    public function __construct()
//    {
//        $this->painting = new ArrayCollection();
//        $this->gallery = new ArrayCollection();
//    }
    public function __construct()
    {
        $this->isActive = true;
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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getResidence(): ?string
    {
        return $this->residence;
    }

    public function setResidence(?string $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

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

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate(): self
    {
        $this->createDate = new \DateTime('Now');;

        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate(): self
    {
        $this->updateDate = $this->createDate = new \DateTime('Now');;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->Facebook;
    }

    public function setFacebook(?string $Facebook): self
    {
        $this->Facebook = $Facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->Twitter;
    }

    public function setTwitter(?string $Twitter): self
    {
        $this->Twitter = $Twitter;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->Linkedin;
    }

    public function setLinkedin(?string $Linkedin): self
    {
        $this->Linkedin = $Linkedin;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->Instagram;
    }

    public function setInstagram(?string $Instagram): self
    {
        $this->Instagram = $Instagram;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }




}
