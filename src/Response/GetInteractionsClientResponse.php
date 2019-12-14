<?php


namespace App\Response;


class GetInteractionsClientResponse
{
    public $id;
    public $interaction;
    public $date;
    public $entity;
    public $interactionID;

    /**
     * @return mixed
     */
    public function getInteractionID()
    {
        return $this->interactionID;
    }

    /**
     * @param mixed $interactionID
     */
    public function setInteractionID($interactionID): void
    {
        $this->interactionID = $interactionID;
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