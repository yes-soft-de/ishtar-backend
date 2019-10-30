<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface EntityInteractionServiceInterface
{
    public function create ($request);
    public function update( $request);
    public function delete( $request);
    public function getAll($request);
    public function getEntityInteraction($request);
    public function getClientInteraction($request);
}