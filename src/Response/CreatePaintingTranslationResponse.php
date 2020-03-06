<?php


namespace App\Response;


class CreatePaintingTranslationResponse
{
    public $originID;
    public $name;

    /**
     * @return mixed
     */
    public function getOriginID()
    {
        return $this->originID;
    }

    /**
     * @param mixed $originID
     */
    public function setOriginID($originID): void
    {
        $this->originID = $originID;
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


}