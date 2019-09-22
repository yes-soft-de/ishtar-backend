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
        $facebbok=$data['Facebook'];
        $twitter=$data['Twitter'];
        $instagram=$data['Instagram'];
        $linkedin=$data['Linkedin'];

        $artist->setName($name)
            ->setNationality($nationality)
            ->setResidence($residence)
            ->setBirthDate($birthDate)
            ->setStory($story)
            ->setDetails($details)
            ->setFacebook($facebbok)
            ->setTwitter($twitter)
            ->setInstagram($instagram)
            ->setLinkedin($linkedin);

        return $artist;
    }
}