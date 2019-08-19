<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaintingController extends AbstractController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createPainting", name="createPainting")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->create($request, "Painting");
        return $result;
    }

    /**
     * @Route("/updatePainting", name="updatePainting")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "Painting");
        return $result;
    }

    /**
     * @Route("/deletePainting", name="deletePainting")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "Painting");
        return $result;
    }
}
