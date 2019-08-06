<?php

namespace App\Controller;

use App\Service\ArtistServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->artistService->createArtist($request, "Artist");
        return $result;
    }

    /**
     * @Route("/updateArtist", name="updateArtist")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->artistService->updateArtist($request, "Artist");
        return $result;
    }

    /**
     * @Route("/deleteArtist", name="deleteArtist")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->artistService->deleteArtist($request, "Artist");
        return $result;
    }
}
