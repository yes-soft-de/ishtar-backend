<?php

namespace App\Controller;

use App\Validator\ArtTypeValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtTypeController extends BaseController
{
    /**
     * @Route("/createArtType", name="createArtType")
     * @param Request $request
     * @return
     */
    public function create(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        //Validation
        $validateResult = $artTypeValidate->artTypeValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "ArtType");
        return $this->response($result, self::CREATE,"ArtType");
    }

    /**
     * @Route("/updateArtType", name="updateArtType")
     * @param Request $request
     * @return
     */
    public function update(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        $validateResult = $artTypeValidate->artTypeValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "ArtType");
        return $this->response($result, self::UPDATE, "ArtType");
    }

    /**
     * @Route("/deleteArtType", name="deleteArtType")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        $validateResult = $artTypeValidate->artTypeValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "ArtType");
        return $this->response($result, self::DELETE, "ArtType");

    }


    /**
     * @Route("/getAllArtType",name="getAllArtType")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {
        //ToDo Call Validator

        $result = $this->FDService->fetchData($request,"ArtType");
        return $this->response($result,self::FETCH,"ArtType");
    }

    /**
     * @Route("/getArtTypeById", name="getArtTypeById")
     * @param Request $request
     * @return
     */
    public function getArtTypeById(Request $request)
    {
        $result = $this->FDService->getArtTypeById($request);
        return $this->response($result,self::FETCH,"ArtType");
    }
    /**
     * @Route("/getArtTypeList", name="getArtTypeList")
     * @param Request $request
     * @return
     */
    public function getArtTypelist()
    {
        $result = $this->FDService->getArtTypelist();
        return $this->response($result,self::FETCH,"ArtType");
    }

    }
