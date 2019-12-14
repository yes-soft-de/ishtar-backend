<?php


namespace App\Request;

class CreateStatueRequest
{
    public $name;
    public $artist;
    public $state;
    public $height;
    public $width;
    public $price;
    public $active;
    public $image;
    public $keyWords;
    public $material;
    public $description;
    public $style;
    public $mediums;
    public $features;
    public $period;
    public $weight;
    public $length;
    public $createDate;


    public function __construct()
    {
        $this->createDate = new \DateTime('Now');

    }

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

}