<?php


namespace App\Response;


class UpdateFavoriteResponse
{
    public $id;
    public $painting;
    public $client;

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