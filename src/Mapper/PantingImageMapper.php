<?php


namespace App\Mapper;


use App\Entity\PantingImageEntity;
use DateTime;
use Exception;

class PantingImageMapper
{
    public function PantingImageData($data, PantingImageEntity $PantingImage)
    {
        $paintingId = $data["paintingId"];
        $artist_id_id   = $data["artistId"];
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $date = new DateTime((string)$data["date"]);
        } catch (Exception $e) {
        }
        $url       = $data["url"];

        $PantingImage->setPaintingId($paintingId)
            ->setArtistId($artist_id_id)
            ->setDate($date)
            ->setUrl($url);

        return $PantingImage;
    }

}