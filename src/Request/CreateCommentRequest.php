<?php

namespace App\Request;

class CreateCommentRequest
{
    public $entity;
    public $row;
    public $client;
    public $body;
    public $spacial;
    public $date;


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

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getSpacial()
    {
        return $this->spacial;
    }

    /**
     * @param mixed $spacial
     */
    public function setSpacial($spacial): void
    {
        $this->spacial = $spacial;
    }

}