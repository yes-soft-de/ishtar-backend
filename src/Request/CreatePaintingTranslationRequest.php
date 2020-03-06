<?php


namespace App\Request;


use DateTime;

class CreatePaintingTranslationRequest
{
    public $originID;
    public $name;
    public $createDate;

    public function __construct()
    {
        $this->createDate = new \DateTime('Now');
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate(DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }

    public function getOriginID()
    {
        return $this->originID;
    }

    public function setOriginID($originID): void
    {
        $this->originID = $originID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }



}