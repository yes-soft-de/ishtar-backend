<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArtTypeController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createArtType", name="createArtType")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->CUDService->create($request, "ArtType");
        return $result;
    }

    /**
     * @Route("/updateArtType", name="updateArtType")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->CUDService->update($request, "ArtType");
        return $result;
    }

    /**
     * @Route("/deleteArtType", name="deleteArtType")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call artistValidator

        $result = $this->CUDService->delete($request, "ArtType");
        return $result;
    }
}
