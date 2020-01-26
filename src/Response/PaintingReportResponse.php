<?php


namespace App\Response;


use phpDocumentor\Reflection\Types\Integer;

class PaintingReportResponse
{
    public $id;
    public $name;
    public $viewed;
    public $follower;
    public $likes;
    public $comments;
    public $claps;

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
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * @param mixed $viewed
     */
    public function setViewed($viewed): void
    {
        $this->viewed = $viewed;
    }

    /**
     * @return mixed
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * @param mixed $follower
     */
    public function setFollower($follower): void
    {
        $this->follower = $follower;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comment
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getClaps()
    {
        return $this->claps;
    }

    /**
     * @param mixed $claps
     */
    public function setClaps($claps): void
    {
        $this->claps = $claps;
    }

}