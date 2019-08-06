<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createArtist", name="createArtist")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->createArtist($request, "Artist");
        return $result;
    }

    /**
     * @Route("/updateArtist", name="updateArtist")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->updateArtist($request, "Artist");
        return $result;
    }

    /**
     * @Route("/deleteArtist", name="deleteArtist")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->deleteArtist($request, "Artist");
        return $result;
    }
}
