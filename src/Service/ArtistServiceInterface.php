<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ArtistServiceInterface
{
    public function create ($request);
    public function update( $request);
    public function delete( $request);
    public function getAll();
    public function getArtistById($request);
    public function search(Request $request);
    public function getAllDetails();
}