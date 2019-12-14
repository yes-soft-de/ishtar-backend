<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateAuctionRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateAuctionRequest;
use App\Service\AuctionService;
use App\Validator\AuctionValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends BaseController
{
    private $auctionService;
    private $autoMapping;
    /**
     * ArtistController constructor.
     * @param AuctionService $auctionService
     */
    public function __construct(AuctionService $auctionService,AutoMapping $autoMapping)
    {
        $this->auctionService=$auctionService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/auctions", name="createAuction",methods={"POST"})
     * @param Request $request
     * @param AuctionValidateInterface $auctionValidate
     * @return JsonResponse|Response
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
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateAuctionRequest::class,(object)$data);
        $result = $this->auctionService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/auction/{id}", name="updateAuction",methods={"PUT"})
     * @param Request $request
     * @param AuctionValidateInterface $auctionValidate
     * @return JsonResponse|Response
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
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateAuctionRequest::class,(object)$data);
        $result = $this->auctionService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/auction/{id}", name="deleteAuction",methods={"DELETE"})
     * @param Request $request
     * @param AuctionValidateInterface $auctionValidate
     * @return JsonResponse|Response
     */
    public function delete(Request $request, AuctionValidateInterface $auctionValidate)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->auctionService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/auctions", name="getAllAuction",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->auctionService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/auction/{id}", name="getAuctionById",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuctionById(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->auctionService->getById($request);
        return $this->response($result,self::FETCH);
    }
}
