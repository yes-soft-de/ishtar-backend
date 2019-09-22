<?php

namespace App\Controller;

use App\Validator\CommentValidateInterface;
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
        return $this->response($result, self::CREATE, "Comment");
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
        return $this->response($result, self::UPDATE, "Comment");
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
     * @Route("/getAllComment",name="getAllComment")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Comment");
        return $this->response($result,self::FETCH,"Comment");
    }
    /**
     * @Route("/getEntityInteraction",name="getEntityInteraction")
     * @param Request $request
     * @return
     */
    public function getEntityInteraction(Request $request)
    {

        $result = $this->FDService->getEntityInteraction($request);
        return $this->response($result,self::FETCH,"Comment");
    }
    /**
     * @Route("/getEntityComment",name="getEntityComment")
     * @param Request $request
     * @return
     */
    public function getEntityComment(Request $request)
    {

        $result = $this->FDService->getEntityComment($request);
        return $this->response($result,self::FETCH,"Comment");
    }
}
