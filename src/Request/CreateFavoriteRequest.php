<?php


namespace App\Request;


class CreateFavoriteRequest
{
    public $painting;
    public $client;

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