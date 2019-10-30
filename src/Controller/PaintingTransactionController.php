<?php

namespace App\Controller;

use App\Validator\PaintingTransactionValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingTransactionController extends BaseController
{
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

        $result = $this->CUDService->create($request, "PaintingTransaction");
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
        $result = $this->CUDService->update($request, "PaintingTransaction");
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
        $result = $this->CUDService->delete($request, "PaintingTransaction");
        return $this->response($result, self::DELETE,"PaintingTransaction");

    }


    /**
     * @Route("/getAllPaintingTransaction",name="getAllPaintingTransaction")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"PaintingTransaction");
        return $this->response($result,self::FETCH,"PaintingTransaction");
    }
}
