<?php

namespace App\Controller;


use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClapController extends AbstractController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createClap", name="createClap")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->create($request, "Clap");
        return $result;
    }

    /**
     * @Route("/updateClap", name="updateClap")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "Clap");
        return $result;
    }

    /**
     * @Route("/deleteClap", name="deleteClap")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "Clap");
        return $result;
    }
}
