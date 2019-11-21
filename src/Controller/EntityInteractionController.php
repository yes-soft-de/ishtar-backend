<?php

namespace App\Controller;

use App\Request\CreateInteractionRequest;
use App\Request\GetClientRequest;
use App\Request\GetInterctionEntityRequest;
use App\Request\UpdateInteractionRequest;
use App\Service\EntityInteractionService;
use App\Validator\InteractionValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreateInteractionRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreateInteractionRequest::class);
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
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateInteractionRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdateInteractionRequest::class);
        $request->setId($id);
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
     *@Route("/interactionsentity/{entity}/{row}/{interaction}",name="getEntityInteraction",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getEntityInteraction(Request $request)
    {
        $request=new GetInterctionEntityRequest($request->get('entity'),$request->get('row'),
            $request->get('interaction'));
        $result = $this->interactionService->getEntityInteraction($request);
        return $this->response($result,self::FETCH,"Interaction");
    }
    /**
     * @Route("/interactionsclient/{client}", name="getClientInteraction",methods={"GET"})
     *@param Request $request
     * @return
     */
    public function getClientInteractions(Request $request)
    {
        $request=new GetClientRequest($request->get('client'));
        $result = $this->interactionService->getClientInteraction($request);
        return $this->response($result,self::FETCH,"Interaction");
    }
    /**
     * @Route("/mostviews", name="mostViews",methods={"GET"})
     * @return
     */
    public function getMostViews()
    {
        $result = $this->interactionService->getMostViews();
        return $this->response($result,self::FETCH,"Interaction");
    }
}
