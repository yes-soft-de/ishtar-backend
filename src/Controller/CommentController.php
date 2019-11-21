<?php

namespace App\Controller;

use App\Request\ByIdRequest;
use App\Request\CreateCommentRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetEntityRequest;
use App\Request\UpdateCommentRequest;
use App\Service\CommentService;
use App\Validator\CommentValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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

        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreateCommentRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreateCommentRequest::class);
        $result = $this->commentService->create($request);
        return $this->response($result, self::CREATE);
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
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateCommentRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdateCommentRequest::class);
        $request->setId($id);
        $result = $this->commentService->update($request);
        return $this->response($result, self::UPDATE);
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
        $request=new DeleteRequest($request->get('id'));
        $result = $this->commentService->delete($request);
        return $this->response($result, self::DELETE);

    }


    /**
     * @Route("/commentsentity/{entity}/{row}",name="getEntityComment")
     * @param Request $request
     * @return
     */
    public function getEntityComment(Request $request)
    {
        $request=new GetEntityRequest($request->get('entity'),$request->get('row'));
        $result = $this->commentService->getEntityComment($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/commentsclient/{client}", name="getClientComments",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getClientComment(Request $request)
    {
        $request=new GetClientRequest($request->get('client'));
        $result = $this->commentService->getClientComment($request);
        return $this->response($result,self::FETCH);
    }
    /**
     * @Route("/comments",name="getAllComment",methods={"GET"})
     * @return
     */
    public function getAll()
    {
        $result = $this->commentService->getAll();
        return $this->response($result,self::FETCH);
    }
    /**
     * @Route("/spacialcomment/{id}",name="setSpacialComment",methods={"PUT"})
     * @return
     */
    public function setSpacial(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->commentService->setSpacial($request);
        return $this->response($result,self::UPDATE);
    }
}
