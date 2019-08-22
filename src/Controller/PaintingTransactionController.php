<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\PaintingTransactionValidate;
use App\Validator\PaintingTransactionValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingTransactionController extends BaseController
{
    /**
     * @Route("/createPaintingTransaction", name="createPaintingTransaction")
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

        $result = $this->CUDService->create($request, "PaintingTransaction");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updatePaintingTransaction", name="updatePaintingTransaction")
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
        $result = $this->CUDService->update($request, "PaintingTransaction");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deletePaintingTransaction", name="deletePaintingTransaction")
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
        $result = $this->CUDService->delete($request, "PaintingTransaction");
        return $this->response($result, self::DELETE);

    }


    /**
     * @Route("/getAllPaintingTransaction",name="getAllPaintingTransaction)
     *  @param
     *
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"PaintingTransaction");
        return $this->response($result,self::FETCH,"PaintingTransaction");
    }
}
