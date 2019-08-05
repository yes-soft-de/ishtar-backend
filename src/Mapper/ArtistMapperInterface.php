<?php

namespace App\Mapper;


use App\Entity\ArtistEntity;

interface ArtistMapperInterface
{
    public function artistData($data, ArtistEntity $artist);
}