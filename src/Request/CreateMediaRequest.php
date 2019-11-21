<?php


namespace App\Request;


class CreateMediaRequest
{
public $entity;
public $row;
public $name;
public $path;
public $media=1;
public $createDate;


    public function __construct()
    {
        $this->createDate = new \DateTime('Now');

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

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getMedia(): int
    {
        return $this->media;
    }

    /**
     * @param int $media
     */
    public function setMedia(int $media): void
    {
        $this->media = $media;
    }

}