<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use DateTime;
use Exception;

class ArtistMapper
{
    public function artistData($data, ArtistEntity $artist)
    {

        $name        = $data["name"];
        $nationality = $data["nationality"];
        $residence   = $data["residence"];
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $birthDate = new DateTime((string)$data["birthDate"]);
        } catch (Exception $e) {
        }
        $story       = $data["story"];
        $details     = $data["details"];
        $image       = $data["image"];
        $video       = $data["video"];
        $faceBook    = $data["faceBook"];
        $instagram   = $data["instagram"];
        $twitter     = $data["twitter"];
        $linkedin    = $data["linkedin"];

        $artist->setName($name)
            ->setNationality($nationality)
            ->setResidence($residence)
            ->setBirthDate($birthDate)
            ->setStory($story)
            ->setDetails($details)
            ->setImage($image)
            ->setVideo($video)
            ->setFacebook($faceBook)
            ->setInstagram($instagram)
            ->setTwitter($twitter)
            ->setLinkedin($linkedin);

        return $artist;
    }
}