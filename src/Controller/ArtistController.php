<?php

namespace App\Controller;

use App\Service\ArtistServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    private $artistService;

    public function __construct(ArtistServiceInterface $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * @Route("/createArtist", name="createArtist")
     */
    public function create(Request $request)
    {
        $result = $this->artistService->createPainting($request, "Artist");

        //$response = new JsonResponse($result, $result['status_code']);

        // For Local Server Accessibility
       // $response->headers->set('Access-Control-Allow-Origin', '*');

        return $result;
    }

    /**
     * @Route("/updateArtist", name="updateArtist")
     */
    public function update(Request $request)
    {
        $result = $this->artistService->updatePainting($request, "Artist");

        $response = new JsonResponse($result, $result['status_code']);

        // For Local Server Accessibility
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/deleteArtist", name="deleteArtist")
     */
    public function delete(Request $request)
    {
        $result = $this->artistService->deletePainting($request, "Artist");

        $response = new JsonResponse($result, $result['status_code']);

        // For Local Server Accessibility
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
