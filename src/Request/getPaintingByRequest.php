<?php


namespace App\Request;


class getPaintingByRequest
{
    public $parm;
    public $value;

    /**
     * SearchRequest constructor.
     * @param $parm
     * @param $value
     */
    public function __construct($parm, $value)
    {
        $this->parm = $parm;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getParm()
    {
        return $this->parm;
    }

    /**
     * @param mixed $parm
     */
    public function setParm($parm): void
    {
        $this->parm = $parm;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }


}