<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AuctionPaintingController extends AbstractController

{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createAuctionPainting", name="createAuctionPainting")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->create($request, "AuctionPainting");
        return $result;
    }

    /**
     * @Route("/updateAuctionPainting", name="updateAuctionPainting")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "AuctionPainting");
        return $result;
    }

    /**
     * @Route("/deleteAuctionPainting", name="deleteAuctionPainting")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "AuctionPainting");
        return $result;
    }
}
