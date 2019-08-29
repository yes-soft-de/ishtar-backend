<?php


namespace App\Mapper;


use Symfony\Component\HttpFoundation\Request;

interface BaseFetchDataMapperInterface
{
    public function fetchDataMapper(Request $request, $entity);
    public function getArtistPaintings(Request $request);
    public function getPaintingImages(Request $request);
    public function getArtTypePaintings(Request $request);
}