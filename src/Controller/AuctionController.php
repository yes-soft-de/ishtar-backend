<?php

namespace App\Controller;

use App\Validator\AuctionValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends BaseController
{
    /**
     * @Route("/auctions", name="createAuction",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request, AuctionValidateInterface $auctionValidate)
    {
        //Validation
        $validateResult = $auctionValidate->auctionValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Auction");
        $this->CUDService->create($request,"AuctionPainting");
        return $this->response($result, self::CREATE, "Auction");
    }

    /**
     * @Route("/auction/{id}", name="updateAuction",methods={"PUT"})
     * @param Request $request
     * @return
     */
    public function update(Request $request, AuctionValidateInterface $auctionValidate)
    {
        $validateResult = $auctionValidate->auctionValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Auction");
        return $this->response($result, self::UPDATE, "Auction");
    }

    /**
     *  @Route("/auction/{id}", name="deleteAuction",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request, AuctionValidateInterface $auctionValidate)
    {
        $validateResult = $auctionValidate->auctionValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Auction");
        return $this->response($result, self::DELETE, "Auction");

    }


    /**
     * @Route("/auction/getAll", name="getAllAuction",methods={"GET"})
     *@param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Auction");
        return $this->response($result,self::FETCH,"Auction");
    }

    /**
     * @Route("/getAuctionById", name="getAuctionById")
     * @param Request $request
     * @return
     */
    public function getAuctionById(Request $request)
    {
        $result = $this->FDService->getAuctionById($request);
        return $this->response($result,self::FETCH,"Auction");
    }
}
