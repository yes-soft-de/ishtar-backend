<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\AuctionValidate;
use App\Validator\AuctionValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends BaseController
{
    /**
     * @Route("/createAuction", name="createAuction")
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
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateAuction", name="updateAuction")
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
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteAuction", name="deleteAuction")
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
        return $this->response($result, self::DELETE);

    }
}
