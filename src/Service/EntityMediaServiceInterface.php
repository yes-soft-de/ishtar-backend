<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;

interface EntityMediaServiceInterface
{
    public function create ($request);
    public function update( $request);
    public function delete( $request);
    public function getAll();
    public function getEntityItems($request);

}