<?php


namespace App\Request;


class SaveReportRequest
{
    public $id;
    public $artist;
    public $emailId;
    public $emailData;
    public $status;
    public $sendingDate;

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
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist): void
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param mixed $emailId
     */
    public function setEmailId($emailId): void
    {
        $this->emailId = $emailId;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getSendingDate()
    {
        return $this->sendingDate;
    }

    /**
     * @param mixed $sendingDate
     */
    public function setSendingDate($sendingDate): void
    {
        $this->sendingDate = $sendingDate;
    }

}