<?php


namespace App\Request;


use DateTime;

class UpdatePaintingThumbImageRequest
{
    public $id;
    public $thumbImage;
    public $updatedDate;

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
     * @return DateTime
     */
    public function getUpdatedDate(): DateTime
    {
        return $this->updatedDate;
    }

    /**
     * @param DateTime $updatedDate
     */
    public function setUpdatedDate(DateTime $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    public function __construct()
    {
        $this->updatedDate = new DateTime('Now');
    }
}