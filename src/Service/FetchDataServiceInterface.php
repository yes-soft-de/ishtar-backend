<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface FetchDataServiceInterface
{

    public function fetchData(Request $request, $entity);
    public function getArtistPaintings(Request $request);
    public function getPaintingById(Request $request);
    public function getPaintingImages(Request $request);
}
