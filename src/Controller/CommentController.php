<?php

namespace App\Controller;

use App\Service\CommentService;
use App\Validator\CommentValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends BaseController
{
    private $commentService;

    /**
     * CommentController constructor.
     * @param $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @Route("/comments", name="createComment",methods={"POST"})
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

        $result = $this->commentService->create($request);
        return $this->response($result, self::CREATE, "Comment");
    }

    /**
     * @Route("/comment/{id}", name="updateComment",methods={"PUT"})
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
        $result = $this->commentService->update($request, "Comment");
        return $this->response($result, self::UPDATE, "Comment");
    }

    /**
     *  @Route("/comment/{id}", name="deleteComment",methods={"DELETE"})
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
        $result = $this->commentService->delete($request, "Comment");
        return $this->response($result, self::DELETE,"Comment");

    }


    /**
     * @Route("/getEntityComment",name="getEntityComment")
     * @param Request $request
     * @return
     */
    public function getEntityComment(Request $request)
    {

        $result = $this->commentService->getEntityComment($request);
        return $this->response($result,self::FETCH,"Comment");
    }

    /**
     * @Route("/getClientComment",name="getClientComment")
     * @param Request $request
     * @return
     */
    public function getClientComment(Request $request)
    {

        $result = $this->commentService->getClientComment($request);
        return $this->response($result,self::FETCH,"Comment");
    }
    /**
     * @Route("/comments",name="getClientComment",methods={"GET"})
     * @return
     */
    public function getAll()
    {
        $result = $this->commentService->getAll();
        return $this->response($result,self::FETCH,"Comment");
    }
}
