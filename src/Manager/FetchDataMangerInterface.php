<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\Request;

interface FetchDataMangerInterface
{
    public function fetchData(Request $request,$entity);
    public function getArtistPaintings(Request $request);
    public function getPaintingById(Request $request);
    public function getPaintingImages(Request $request);

}