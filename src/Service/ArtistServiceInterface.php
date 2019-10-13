<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ArtistServiceInterface
{
    public function create(Request $request, $entity);

    public function update(Request $request, $entity);

    public function delete(Request $request, $entity);

}