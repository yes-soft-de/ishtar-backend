<?php


namespace App\Response;


class ArtistReport
{
    public $id;
    public $name;
    public $followers;
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
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * @param mixed $followers
     */
    public function setFollowers($followers): void
    {
        $this->followers = $followers;
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



}