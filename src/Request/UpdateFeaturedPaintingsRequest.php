<?php


namespace App\Request;


use DateTime;

class UpdateFeaturedPaintingsRequest
{
    public $id;
    public $isFeatured;
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
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param mixed $isFeatured
     */
    public function setIsFeatured($isFeatured): void
    {
        $this->isFeatured = $isFeatured;
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