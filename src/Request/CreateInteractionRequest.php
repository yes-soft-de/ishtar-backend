<?php


namespace App\Request;


class CreateInteractionRequest
{
    public $entity;
    public $row;
    public $interaction;
    public $client;
    public $date;

    /**
     * CreateInteractionRequest constructor.
     * @param $date
     */
    public function __construct()
    {
        $this->date = new \DateTime('Now');

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
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

}