<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CreateAuctionPaintingRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateAuctionPaintingRequest;
use App\Service\AuctionPaintingService;
use App\Validator\AuctionPaintingValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionPaintingController extends BaseController
{
    private $auctionPaintingService;
    private $autoMapping;

    /**
     * AuctionPaintingController constructor.
     * @param $auctionPaintingService
     */
    public function __construct(AuctionPaintingService $auctionPaintingService,AutoMapping $autoMapping)
    {
        $this->auctionPaintingService = $auctionPaintingService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/auctionPaintings", name="createAuctionPainting",methods={"POST"})
     * @param Request $request
     * @param AuctionPaintingValidateInterface $auctionPaintingValidate
     * @return JsonResponse|Response
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
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateAuctionPaintingRequest::class,(object)$data);
        $result = $this->auctionPaintingService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/auctionPainting/{id}", name="updateAuctionPainting",methods={"PUT"})
     * @param Request $request
     * @param AuctionPaintingValidateInterface $auctionPaintingValidate
     * @return JsonResponse|Response
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
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateAuctionPaintingRequest::class,(object)$data);
        $result = $this->auctionPaintingService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/auctionPainting/{id}", name="deleteAuctionPainting",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->auctionPaintingService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/auctionpaintings", name="getAllAuctionPainting",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        //ToDo Call Validator

        $result = $this->auctionPaintingService->getAll();
        return $this->response($result,self::FETCH);
    }
}
