<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\CommentValidate;
use App\Validator\CommentValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends BaseController
{
    /**
     * @Route("/createComment", name="createComment")
     * @param Request $request
     * @return
     */
    public function create(Request $request, CommentValidateInterface $commentValidate)
    {
        //Validation
        $validateResult = $commentValidate->commentValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Comment");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateComment", name="updateComment")
     * @param Request $request
     * @return
     */
    public function update(Request $request, CommentValidateInterface $commentValidate)
    {
        $validateResult = $commentValidate->commentValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Comment");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteComment", name="deleteComment")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, CommentValidateInterface $commentValidate)
    {
        $validateResult = $commentValidate->commentValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Comment");
        return $this->response($result, self::DELETE,"Comment");

    }


    /**
     * @Route("/getAllComment",name="getAllComment)
     *  @param
     *
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Comment");
        return $this->response($result,self::FETCH,"Comment");
    }
}
