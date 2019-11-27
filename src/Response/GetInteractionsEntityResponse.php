<?php


namespace App\Response;


class GetInteractionsEntityResponse
{
    public $inteactions;

    /**
     * @return mixed
     */
    public function getInteactions()
    {
        return $this->inteactions;
    }

    /**
     * @param mixed $inteactions
     */
    public function setInteactions($inteactions): void
    {
        $this->inteactions = $inteactions;
    }

}