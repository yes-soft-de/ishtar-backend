<?php


namespace App\Request;


use DateTime;

class UpdateMediaThumbImageRequest
{
    public $id;
    public $thumbImage;
    public $updatedDate;

    public function __construct()
    {
        $this->updatedDate = new DateTime('Now');
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
    public function getThumbImage()
    {
        return $this->thumbImage;
    }

    /**
     * @param mixed $thumbImage
     */
    public function setThumbImage($thumbImage): void
    {
        $this->thumbImage = $thumbImage;
    }

    /**
     * @return mixed
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param mixed $updatedDate
     */
    public function setUpdatedDate($updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

}