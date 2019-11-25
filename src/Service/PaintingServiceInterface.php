<?php

namespace App\Service;


interface PaintingServiceInterface
{
    public function create ($request);
    public function update( $request,$id);
    public function delete( $request);
    public function getAll();
    public function getBy($request);
}