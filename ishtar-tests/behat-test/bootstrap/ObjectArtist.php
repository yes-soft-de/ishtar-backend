<?php

class ObjectArtist
{
    private $Name;
    private $Nationality;
    private $Residence;
    private $BirthDate;
    private $Story;
    private $Details;
    private $Image;
    private $ArtType;
    private $Facebook;
    private $Instagram;
    private $Twitter;
    private $LikedIn;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->Nationality;
    }

    /**
     * @param mixed $Nationality
     */
    public function setNationality($Nationality): void
    {
        $this->Nationality = $Nationality;
    }

    /**
     * @return mixed
     */
    public function getResidence()
    {
        return $this->Residence;
    }

    /**
     * @param mixed $Residence
     */
    public function setResidence($Residence): void
    {
        $this->Residence = $Residence;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->BirthDate;
    }

    /**
     * @param mixed $BirthDate
     */
    public function setBirthDate($BirthDate): void
    {
        $this->BirthDate = $BirthDate;
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->Story;
    }

    /**
     * @param mixed $Story
     */
    public function setStory($Story): void
    {
        $this->Story = $Story;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->Details;
    }

    /**
     * @param mixed $Details
     */
    public function setDetails($Details): void
    {
        $this->Details = $Details;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * @param mixed $Image
     */
    public function setImage($Image): void
    {
        $this->Image = $Image;
    }

    /**
     * @return mixed
     */
    public function getArtType()
    {
        return $this->ArtType;
    }

    /**
     * @param mixed $ArtType
     */
    public function setArtType($ArtType): void
    {
        $this->ArtType = $ArtType;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->Facebook;
    }

    /**
     * @param mixed $Facebook
     */
    public function setFacebook($Facebook): void
    {
        $this->Facebook = $Facebook;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->Instagram;
    }

    /**
     * @param mixed $Instagram
     */
    public function setInstagram($Instagram): void
    {
        $this->Instagram = $Instagram;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->Twitter;
    }

    /**
     * @param mixed $Twitter
     */
    public function setTwitter($Twitter): void
    {
        $this->Twitter = $Twitter;
    }

    /**
     * @return mixed
     */
    public function getLikedIn()
    {
        return $this->LikedIn;
    }

    /**
     * @param mixed $LikedIn
     */
    public function setLikedIn($LikedIn): void
    {
        $this->LikedIn = $LikedIn;
    }
}
