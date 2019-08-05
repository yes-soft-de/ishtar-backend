<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ArtistServiceInterface
{
    public function createPainting(Request $request, $entity);

    public function updatePainting(Request $request, $entity);

    public function deletePainting(Request $request, $entity);
}