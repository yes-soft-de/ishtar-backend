<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CreateInteractionRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetInterctionEntityRequest;
use App\Request\UpdateInteractionRequest;
use App\Service\EntityInteractionService;
use App\Validator\InteractionValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntityInteractionController extends BaseController
{
    private $interactionService;
    private $autoMapping;

    /**
     * EntityInteractionController constructor.
     * @param $interactionService
     */
    public function __construct(EntityInteractionService $interactionService,AutoMapping $autoMapping)
    {
        $this->interactionService = $interactionService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/interactions", name="createInteraction",methods={"POST"})
     * @param Request $request
     * @param InteractionValidateInterface $interactionValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
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

        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateInteractionRequest::class,(object)$data);
        $result = $this->interactionService->create($request);

        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/interaction/{id}", name="updateInteraction",methods={"PUT"})
     * @param Request $request
     * @param InteractionValidateInterface $interactionValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
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
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateInteractionRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->interactionService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/interaction/{id}", name="deleteInteraction",methods={"DELETE"})
     * @param Request $request
     * @param InteractionValidateInterface $interactionValidate
     * @return JsonResponse
     */
    public function delete(Request $request, InteractionValidateInterface $interactionValidate)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->interactionService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/interactions", name="getAllInteraction",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {

        $result = $this->interactionService->getAll($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/interactionsentity/{entity}/{row}/{interaction}",name="getEntityInteraction",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getEntityInteraction(Request $request)
    {
        $request = new GetInterctionEntityRequest($request->get('entity'),$request->get('row'),
            $request->get('interaction'));

        $result = $this->interactionService->getEntityInteraction($request);

        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/interactionsclient/{client}", name="getClientInteraction",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getClientInteractions(Request $request)
    {
        $request=new GetClientRequest($request->get('client'));
        $result = $this->interactionService->getClientInteraction($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/mostviews", name="mostViews",methods={"GET"})
     * @return JsonResponse
     */
    public function getMostViews()
    {
        $result = $this->interactionService->getMostViews();
        return $this->response($result,self::FETCH);
    }
}
