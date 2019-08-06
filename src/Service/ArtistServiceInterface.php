<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ArtistServiceInterface
{
    public function createArtist(Request $request, $entity);

    public function updateArtist(Request $request, $entity);

    public function deleteArtist(Request $request, $entity);
}