<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\ClapValidate;
use App\Validator\ClapValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClapController extends BaseController
{
    /**
     * @Route("/createClap", name="createClap")
     * @param Request $request
     * @return
     */
    public function create(Request $request, ClapValidateInterface $clapValidate)
    {
        //Validation
        $validateResult = $clapValidate->clapValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "clap");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateclap", name="updateClap")
     * @param Request $request
     * @return
     */
    public function update(Request $request, ClapValidateInterface $clapValidate)
    {
        $validateResult = $clapValidate->clapValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Clap");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteClap", name="deleteClap")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ClapValidateInterface $clapValidate)
    {
        $validateResult = $clapValidate->clapValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Clap");
        return $this->response($result, self::DELETE);

    }
}
