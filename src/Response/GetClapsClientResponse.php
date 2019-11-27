<?php


namespace App\Response;


class GetClapsClientResponse
{
    public $id;
    public $value;
    public $date;
    public $entity;
    public $clapId;

    /**
     * @return mixed
     */
    public function getClapId()
    {
        return $this->clapId;
    }

    /**
     * @param mixed $clapId
     */
    public function setClapId($clapId): void
    {
        $this->clapId = $clapId;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
    
}