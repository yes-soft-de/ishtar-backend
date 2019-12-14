<?php


namespace App\Response;


class UpdateAuctionPaintingResponse
{
    public $id;
    public $painting;
    public $auction;
    public $client;
    public $startPrice;
    public $finalPrice;
    public $highestPrice;

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
    public function getAuction()
    {
        return $this->auction;
    }

    /**
     * @param mixed $auction
     */
    public function setAuction($auction): void
    {
        $this->auction = $auction;
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
    public function getStartPrice()
    {
        return $this->startPrice;
    }

    /**
     * @param mixed $startPrice
     */
    public function setStartPrice($startPrice): void
    {
        $this->startPrice = $startPrice;
    }

    /**
     * @return mixed
     */
    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    /**
     * @param mixed $finalPrice
     */
    public function setFinalPrice($finalPrice): void
    {
        $this->finalPrice = $finalPrice;
    }

    /**
     * @return mixed
     */
    public function getHighestPrice()
    {
        return $this->highestPrice;
    }

    /**
     * @param mixed $highestPrice
     */
    public function setHighestPrice($highestPrice): void
    {
        $this->highestPrice = $highestPrice;
    }

}