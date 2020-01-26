<?php


namespace App\Request;


class UpdateFavoriteRequest
{
    public $id;
    public $client;
    public $painting;

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
    public function getPainting()
    {
        return $this->painting;
    }

    /**
     * @param mixed $painting
     */
    public function setPainting($painting): void
    {
        $this->painting = $painting;
    }

}