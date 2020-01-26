<?php


namespace App\Response;


class GetMostViewsResponse
{
    public $id;
    public $name;
    public $artist;
    public $entity;
    public $viewed;
    public $image;
    public $height;
    public $width;
    public $colorsType;
    public $artistID;

    /**
     * @return mixed
     */
    public function getArtistID()
    {
        return $this->artistID;
    }

    /**
     * @param mixed $artistID
     */
    public function setArtistID($artistID): void
    {
        $this->artistID = $artistID;
    }
    
    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity): void
    {
        $this->entity = $entity;
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
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * @param mixed $viewed
     */
    public function setViewed($viewed): void
    {
        $this->viewed = $viewed;
    }

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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getColorsType()
    {
        return $this->colorsType;
    }

    /**
     * @param mixed $colorsType
     */
    public function setColorsType($colorsType): void
    {
        $this->colorsType = $colorsType;
    }

}