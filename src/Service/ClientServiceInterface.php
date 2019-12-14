<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ClientServiceInterface
{
    public function register ($request);
    public function login( $request);
    public function update($request);
    public function delete($request);
    public function getAll();
    public function getById($requset);

}