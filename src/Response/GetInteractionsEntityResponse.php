<?php


namespace App\Response;


class GetInteractionsEntityResponse
{
    public $interactions;

    /**
     * @return mixed
     */
    public function getInteractions()
    {
        return $this->interactions;
    }

    /**
     * @param mixed $interactions
     */
    public function setInteractions($interactions): void
    {
        $this->interactions = $interactions;
    }


}