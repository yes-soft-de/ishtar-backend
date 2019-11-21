<?php


namespace App\Request;


class GetInterctionEntityRequest
{
public $entity;
public $row;
public $interaction;

    /**
     * GetInterctionEntityRequest constructor.
     * @param $entity
     * @param $row
     * @param $interaction
     */
    public function __construct($entity, $row, $interaction)
    {
        $this->entity = $entity;
        $this->row = $row;
        $this->interaction = $interaction;
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

    /**
     * @return mixed
     */
    public function getInteraction()
    {
        return $this->interaction;
    }

    /**
     * @param mixed $interaction
     */
    public function setInteraction($interaction): void
    {
        $this->interaction = $interaction;
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