<?php

namespace App\Controller;

use App\Service\EntityInteractionService;
use App\Validator\InteractionValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntityInteractionController extends BaseController
{
    private $interactionService;

    /**
     * EntityInteractionController constructor.
     * @param $interactionService
     */
    public function __construct(EntityInteractionService $interactionService)
    {
        $this->interactionService = $interactionService;
    }

    /**
     * @Route("/interactions", name="createInteraction",methods={"POST"})
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

        $result = $this->interactionService->create($request);
        return $this->response($result, self::CREATE,"EntityInteraction");
    }

    /**
     * @Route("/interaction/{id}", name="updateInteraction",methods={"PUT"})
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
        $result = $this->interactionService->update($request);
        return $this->response($result, self::UPDATE,"Interaction");
    }

    /**
     *  @Route("/interaction/{id}", name="deleteInteraction",methods={"DELETE"})
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
        $result = $this->interactionService->delete($request);
        return $this->response($result, self::DELETE,"Interaction");

    }


    /**
     * @Route("/interactions", name="getAllInteraction",methods={"GET"})
     *@param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->interactionService->getAll($request);
        return $this->response($result,self::FETCH,"Interaction");
    }
    /**
     * @Route("/interaction/entity",name="getInteraction",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getEntityInteraction(Request $request)
    {

        $result = $this->interactionService->getEntityInteraction($request);
        return $this->response($result,self::FETCH,"Comment");
    }
    /**
     * @Route("/getInteraction",name="getInteraction")
     *@param Request $request
     * @return
     */
    public function getInteraction(Request $request)
    {
        $result = $this->interactionService->getInteraction($request);
        return $this->response($result,self::FETCH,"Interaction");
    }
}
