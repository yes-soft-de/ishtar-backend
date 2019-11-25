<?php

namespace App\Controller;

use App\Request\ByIdRequest;
use App\Request\DeleteRequest;
use App\Request\RegisterRequest;
use App\Request\UpdateClientRequest;
use App\Service\ClientService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ClientValidateInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ClientController extends BaseController{
private $clientService;

    public function __construct(ClientService $clientService)
{
    $this->clientService=$clientService;
}

    /**
     * @Route("/client/{id}", name="updateClient",methods={"PUT"})
     * @param Request $request
     * @param ClientValidateInterface $clientValidate
     * @return Response
     * @throws UnregisteredMappingException
     */
    public function update(Request $request,ClientValidateInterface $clientValidate)
    {
        $validateResult = $clientValidate->clientValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateClientRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdateClientRequest::class);
        $request->setId($id);
        $result = $this->clientService->update($request);
        return $this->response($result,self::UPDATE);
    }

    /**
     * @Route("/client/{id}", name="deleteClient",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->clientService->delete($request);
        return $this->response($result,self::DELETE);
    }

    /**
     * @Route("/clients", name="getAllClient",methods={"GET"})
     * @return
     */
    public function getAll()
    {
        $result = $this->clientService->getAll();
        return $this->response($result,self::FETCH);
    }
    /**
     * @Route("/client/{id}", name="getClientById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getClientById(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->clientService->getById($request);
        return $this->response($result,self::FETCH);
    }
    public function register(Request $request, ValidatorInterface $validator)
    {
        //validation
        $errors = $validator->validate($request);

        if (count($errors) > 0)
        {
            $errorsString = (string) $errors;
            return $this->respondUnauthorized($errorsString) ;
        }
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, RegisterRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, RegisterRequest::class);
        $client= $this->clientService->register($request);
        return $this->response(sprintf('User %s successfully created', $client->getEmail()),self::CREATE);
    }

    public function api()
    {
        return $this->response(sprintf('Logged in as %s', $this->getUser()->GetEmail()),self::STATE_OK);
    }
}
