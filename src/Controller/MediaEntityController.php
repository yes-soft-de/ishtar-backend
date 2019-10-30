<?php

namespace App\Controller;

use App\Validator\CommentValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaEntityController extends BaseController
{
    /**
     * @Route("/medias", name="createMedia",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request, CommentValidateInterface $commentValidate)
    {

        $result = $this->CUDService->create($request, "MediaEntity");
        return $this->response($result, self::CREATE, "MediaEntity");
    }

    /**
     *@Route("/media/{id}", name="updateMedia",methods={"PUT"})
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
        $result = $this->CUDService->update($request, "MediaEntity");
        return $this->response($result, self::UPDATE, "MediaEntity");
    }

    /**
     *  @Route("/media/{id}", name="deleteMedia",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request, CommentValidateInterface $commentValidate)
    {
//        $validateResult = $commentValidate->commentValidator($request, 'delete');
//        if (!empty($validateResult))
//        {
//            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
//            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
//            return $resultResponse;
//        }
        $result = $this->CUDService->delete($request, "MediaEntity");
        return $this->response($result, self::DELETE,"MediaEntity");

    }


    /**
     * @Route("/media/getAll", name="getAllMedia",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Comment");
        return $this->response($result,self::FETCH,"Comment");
    }
}
