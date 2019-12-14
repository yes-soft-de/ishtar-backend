<?php


namespace App\Response;


class GetCommentsResponse
{
    public $id;
    public $body;
    public $date;
    public $lastEdit;
    public $spacial;
    public $entity;
    public $row;
    public $username;

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
    public function getLastEdit()
    {
        return $this->lastEdit;
    }

    /**
     * @param mixed $lastEdit
     */
    public function setLastEdit($lastEdit): void
    {
        $this->lastEdit = $lastEdit;
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

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
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