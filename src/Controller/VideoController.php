<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\VideoValidate;
use App\Validator\VideoValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends BaseController
{
    /**
     * @Route("/createVideo", name="createVideo")
     * @param Request $request
     * @return
     */
    public function create(Request $request, VideoValidateInterface $videoValidate)
    {
        //Validation
        $validateResult = $videoValidate->videoValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Video");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateVideo", name="updateVideo")
     * @param Request $request
     * @return
     */
    public function update(Request $request, VideoValidateInterface $videoValidate)
    {
        $validateResult = $videoValidate->videoValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Video");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteVideo", name="deleteVideo")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, VideoValidateInterface $videoValidate)
    {
        $validateResult = $videoValidate->videoValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Video");
        return $this->response($result, self::DELETE);

    }


    /**
     * @Route("/getAllVideo",name="getAllVideo)
     *  @param
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Video");
        return $this->response($result,self::FETCH,"Video");
    }
}
