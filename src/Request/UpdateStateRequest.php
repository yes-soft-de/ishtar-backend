<?php


namespace App\Request;


class UpdateStateRequest
{
    public $id;
    public $state;


    /**
     * UpdateStateRequest constructor.
     * @param $id
     * @param $state
     */
    public function __construct($id, $state)
    {
        $this->id = $id;
        $this->state = $state;
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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }


}