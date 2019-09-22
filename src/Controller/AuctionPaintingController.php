<?php

namespace App\Controller;

use App\Validator\AuctionPaintingValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionPaintingController extends BaseController
{
    /**
     * @Route("/createAuctionPainting", name="createAuctionPainting")
     * @param Request $request
     * @return
     */
    public function create(Request $request, AuctionPaintingValidateInterface $auctionPaintingValidate)
    {
        //Validation
        $validateResult = $auctionPaintingValidate->auctionPaintingValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "AuctionPainting");
        return $this->response($result, self::CREATE, "AuctionPainting");
    }

    /**
     * @Route("/updateAuctionPainting", name="updateAuctionPainting")
     * @param Request $request
     * @return
     */
    public function update(Request $request, AuctionPaintingValidateInterface $auctionPaintingValidate)
    {
        $validateResult = $auctionPaintingValidate->auctionPaintingValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "AuctionPainting");
        return $this->response($result, self::UPDATE, "AuctionPainting");
    }

    /**
     * @Route("/deleteAuctionPainting", name="deleteAuctionPainting")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, AuctionPaintingValidateInterface $auctionPaintingValidate)
    {
        $validateResult = $auctionPaintingValidate->auctionPaintingValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "AuctionPainting");
        return $this->response($result, self::DELETE, "AuctionPainting");

    }

    /**
     * @Route("/getAllAuctionPainting",name="getAllAuctionPainting")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {
        //ToDo Call Validator

        $result = $this->FDService->fetchData($request,"AuctionPainting");
        return $this->response($result,self::FETCH,"AuctionPainting");
    }
}
