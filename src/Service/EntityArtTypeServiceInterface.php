<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface EntityArtTypeServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $entity);

    public function delete(Request $request, $entity);
    public function getAll();

}