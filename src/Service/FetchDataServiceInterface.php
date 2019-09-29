<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface FetchDataServiceInterface
{

    public function fetchData(Request $request, $entity);
    public function getArtistPaintings(Request $request);
    public function getPaintingById(Request $request);
   // public function getPaintingImages(Request $request);
    public function getArtistById(Request $request);
    public function getArtTypeById(Request $request);
    public function getClientById(Request $request);
    public function getAuctionById(Request $request);
    public function getArtTypePaintings(Request $request);
    public function getBy(Request $request);
    public function getPaintingShort();
    public function getArtTypeList();
    public function getArtistsData($request);
    public function getEntityNames($request);
    public function getEntityInteraction($request);
    public function getEntityComment($request);
    public function getEntityClap($request);
    public function search($request);
    public function getInteraction($request);
}
