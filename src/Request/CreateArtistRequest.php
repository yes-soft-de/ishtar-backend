<?php


namespace App\Request;


use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

class CreateArtistRequest
{
    /**
     * @Assert\NotBlank
     */
    public $name;
    public $nationality;
    public $residence;
    public $story;
    public $details;
    public $gallery;
    public $createdBy;
    public $updatedBy;
    public $Facebook;
    public $Twitter;
    public $Linkedin;
    public $Instagram;
    public $artType;
    public $image;
    public $createDate;


    public function __construct()
    {
        $this->createDate = new \DateTime('Now');

    }

    /**
     *
     * @Assert\Date
     *
     */
    public  $birthDate ;

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

