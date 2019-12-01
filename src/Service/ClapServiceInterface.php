<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ClapServiceInterface
{
    public function create ($request);
    public function update( $request);
    public function delete( $request);
    public function getEntityClap($request);
    public function getClientClap($request);
    public function getAll();
}