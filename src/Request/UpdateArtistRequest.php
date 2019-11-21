<?php


namespace App\Request;


class UpdateArtistRequest
{
    public $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @Assert\NotBlank
     */
    public $name;
    /**
     * @Assert\NotBlank
     */
    public $nationality;
    /**
     * @Assert\NotBlank
     */
    public $residence;
    /**
     * @Assert\NotBlank
     */
    public $story;
    public $details;
    public $gallery;
    public $createdBy;
    public $createDate;
    public $updatedBy;
    public $updateDate;
    public $Facebook;
    public $Twitter;
    public $Linkedin;
    public $Instagram;
    public $artType;
    public $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getArtType()
    {
        return $this->artType;
    }

    /**
     * @param mixed $artType
     */
    public function setArtType($artType): void
    {
        $this->artType = $artType;
    }
    /**
     * @Assert\NotBlank
     * @Assert\Date
     */
    public $birthDate;


}