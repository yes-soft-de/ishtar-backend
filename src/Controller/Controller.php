<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/m", name="m")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Controller.php',
        ]);
    }
    /**
     * @Route("headers", name="pre/flight",methods="GET")
     */
    public function getHeaders()
    {
        $resultResponse = new Response("STATE_OK", Response::HTTP_OK, ['content-type' => 'application/json']);
        $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
        $resultResponse->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $resultResponse->headers->set('Access-Control-Allow-Headers', 'DNT,User-Agent,X-Requested-With, If-Modified-Since, Cache-Control, Content-Type,Range, Authorization');
        $resultResponse->headers->set('Access-Control-Max-Age', 1728000);
       // $resultResponse->headers->set('Content-Length', 0);
        $resultResponse->headers->set('Content-Type', 'text/plain; charset=utf-8');
        return $resultResponse;
    }
}
