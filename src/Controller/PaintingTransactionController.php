<?php

namespace App\Controller;

use App\Service\AuctionPainitngServiceInterface;
use App\Service\AuctionPaintingService;
use App\Validator\PaintingTransactionValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingTransactionController extends BaseController
{
    private $auctionPaintingService;
    /**
     * PaintingController constructor.
     */
    public function __construct(AuctionPaintingService $auctionPaintingService)
    {
        $this->auctionPaintingService=$auctionPaintingService;
    }
    /**
     * @Route("/paintingTransactions", name="createPaintingTransaction")
     * @param Request $request
     * @return
     */
    public function create(Request $request, PaintingTransactionValidateInterface $paintingTransactionValidate)
    {
        //Validation
        $validateResult = $paintingTransactionValidate->paintingTransactionValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->auctionPaintingService->create($request);
        return $this->response($result, self::CREATE,"PaintingTransaction");
    }

    /**
     * @Route("/paintingTransaction/{id}", name="updatePaintingTransaction",methods={"PUT"})
     * @param Request $request
     * @return
     */
    public function update(Request $request, PaintingTransactionValidateInterface $paintingTransactionValidate)
    {
        $validateResult = $paintingTransactionValidate->paintingTransactionValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->auctionPaintingService->update($request);
        return $this->response($result, self::UPDATE,"PaintingTransaction");
    }

    /**
     *  @Route("/paintingTransaction/{id}", name="deletePaintingTransaction",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request, PaintingTransactionValidateInterface $paintingTransactionValidate)
    {
        $validateResult = $paintingTransactionValidate->paintingTransactionValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->auctionPaintingService->delete($request);
        return $this->response($result, self::DELETE,"PaintingTransaction");

    }


    /**
     * @Route("/transactions",name="getAllPaintingTransaction",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->auctionPaintingService->getAll($request);
        return $this->response($result,self::FETCH,"PaintingTransaction");
    }
}
