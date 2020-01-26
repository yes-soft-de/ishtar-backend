<?php


namespace App\Request;


class GetEntityRequest
{
public $entity;
public $row;

    /**
     * GetEntityRequest constructor.
     * @param $entity
     * @param $row
     */
    public function __construct($entity, $row)
    {
        $this->entity = $entity;
        $this->row = $row;
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
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row): void
    {
        $this->row = $row;
    }

}