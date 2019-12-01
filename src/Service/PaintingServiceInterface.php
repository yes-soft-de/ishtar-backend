<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface PaintingServiceInterface
{
    public function create ($request);

    public function update( $request,$id);

    public function delete( $request);
    public function getAll();
    public function getArtistPaintings(Request $request);
    public function getPaintingById($request);
    public function getPaintingImages(Request $request);
    public function getBy(Request $request);
}