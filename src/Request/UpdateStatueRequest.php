<?php


namespace App\Request;

class UpdateStatueRequest
{
    public $id;
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
    public $updatedDate;


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

}