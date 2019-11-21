<?php


namespace App\Request;

class CreatePaintingRequest
{
public $name;

private $artist;

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist): void
    {
        $this->artist = $artist;
    }
public $state;
public $height;
public $width;
public $colorsType;
public $price;
public $story;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
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
public $image;
public $active;
public $keyWords;
public $artType;
    public $createDate;


    public function __construct()
    {
        $this->createDate = new \DateTime('Now');

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