<?php

namespace App\Controller;

use App\Validator\InteractionValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InteractionController extends BaseController
{
    /**
     * @Route("/createNewInteraction", name="createNewInteraction")
     * @param Request $request
     * @return
     */
    public function create(Request $request, InteractionValidateInterface $interactionValidate)
    {
        //Validation
        $validateResult = $interactionValidate->interactionValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Interaction");
        return $this->response($result, self::CREATE,"Interaction");
    }

    /**
     * @Route("/updateInteraction", name="updateInteraction")
     * @param Request $request
     * @return
     */
    public function update(Request $request, InteractionValidateInterface $interactionValidate)
    {
        $validateResult = $interactionValidate->interactionValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Interaction");
        return $this->response($result, self::UPDATE,"Interaction");
    }

    /**
     * @Route("/deleteAnInteraction", name="deleteAnInteraction")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, InteractionValidateInterface $interactionValidate)
    {
        $validateResult = $interactionValidate->interactionValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Interaction");
        return $this->response($result, self::DELETE,"Interaction");

    }


    /**
     * @Route("/getAllInteraction",name="getAllInteraction")
     *@param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Interaction");
        return $this->response($result,self::FETCH,"Interaction");
    }
    /**
     * @Route("/getInteraction",name="getInteraction")
     *@param Request $request
     * @return
     */
    public function getInteraction(Request $request)
    {
        $result = $this->FDService->getInteraction($request);
        return $this->response($result,self::FETCH,"Interaction");
    }
}
