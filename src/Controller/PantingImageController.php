<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PantingImageController extends AbstractController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createPantingImage", name="createPantingImage")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->createArtist($request, "PantingImage");
        return $result;
    }

    /**
     * @Route("/updatePantingImage", name="updatePantingImage")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->updateArtist($request, "PantingImage");
        return $result;
    }

    /**
     * @Route("/deletePantingImage", name="deletePantingImage")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->deleteArtist($request, "PantingImage");
        return $result;
    }
}
