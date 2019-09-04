<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\VideoEntity;
use App\Entity\PaintingEntity;
use DateTime;
use Exception;

class VideoMapper
{
    private $en;
    public function VideoData($data, VideoEntity $Video,$entityManger)
    {
        $this->en=$entityManger;
        $painting = $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);
        $artist   =$this->en->getRepository(ArtistEntity::class)->find($data["artist"]);
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $addingDate = new DateTime((string)$data["addingDate"]);
        } catch (Exception $e) {
        }
        $url       = $data["url"];

        $Video->setPainting($painting)
            ->setArtist($artist)
            ->setAddingDate($addingDate)
            ->setUrl($url);

        return $Video;
    }

}