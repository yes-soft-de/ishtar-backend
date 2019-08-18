<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface CreateUpdateDeleteServiceInterface
{
    public function createArtist(Request $request, $entity);

    public function updateArtist(Request $request, $entity);

    public function deleteArtist(Request $request, $entity);
}