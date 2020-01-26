<?php


namespace App\Response;


class ClientReport
{
    public $id;
    public $email;
    public $username;
    public $mostViewed;
    public $emailData;


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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function getEmailData()
    {
        return $this->emailData;
    }

    /**
     * @param mixed $emailData
     */
    public function setEmailData($emailData): void
    {
        $this->emailData = $emailData;
    }

    /**
     * @return mixed
     */
    public function getMostViewed()
    {
        return $this->mostViewed;
    }

    /**
     * @param mixed $mostViewed
     */
    public function setMostViewed($mostViewed): void
    {
        $this->mostViewed = $mostViewed;
    }

}