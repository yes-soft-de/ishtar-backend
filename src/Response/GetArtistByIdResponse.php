<?php


namespace App\Response;


class GetArtistByIdResponse
{

public $id;
public $name;
public $nationality;
public $residence;
public $birthDate;
public $story;
public $Facebook;
public $Twitter;
public $Instagram;
public $Linkedin;
public $path;
public $details;
public $artType;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @param mixed $residence
     */
    public function setResidence($residence): void
    {
        $this->residence = $residence;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param mixed $story
     */
    public function setStory($story): void
    {
        $this->story = $story;
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
    public function getLinkedin()
    {
        return $this->Linkedin;
    }

    /**
     * @param mixed $Linkedin
     */
    public function setLinkedin($Linkedin): void
    {
        $this->Linkedin = $Linkedin;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
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

}