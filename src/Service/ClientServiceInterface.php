<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ClientServiceInterface
{
    public function register ($request);
    public function login( $request);
}