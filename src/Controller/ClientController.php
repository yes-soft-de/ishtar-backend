<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\DeleteRequest;
use App\Request\RegisterRequest;
use App\Request\UpdateClientLanguageRequest;
use App\Request\UpdateClientRequest;
use App\Response\ClientReport;
use App\Service\ClientService;
use App\Service\ReportService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ClientValidateInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ClientController extends BaseController

{
    private $clientService;
    private $autoMapping;
    private $reportService;

    public function __construct(ClientService $clientService,AutoMapping $autoMapping,ReportService $reportService)
    {
        $this->clientService=$clientService;
        $this->autoMapping=$autoMapping;
        $this->reportService=$reportService;
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
        $request=$this->autoMapping->map(\stdClass::class,UpdateClientRequest::class,(object)$data);
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
        $request=$this->autoMapping->map(\stdClass::class,RegisterRequest::class,(object)$data);
        $client= $this->clientService->register($request);
        return $this->response(sprintf('User %s successfully created', $client->getEmail()),self::CREATE);
    }

    public function api()
    {
        return $this->response(sprintf('Logged in as %s', $this->getUser()->GetEmail()),self::STATE_OK);
    }
    /**
     * @Route("/sendreportstoclients", name="sendReportsToClients",methods={"POST"})
     *
     * @return
     */
    public function sendReport()
    {
        $result = $this->reportService->sendReportsToClients();

        return $this->response($result, self::FETCH);

       /* dd($this->reportService->createClientReport(16));*/
    }

    /**
     * @Route("/clientlanguage/{id}", name = "updateClientLanguage", methods={"PUT"})
     */
    public function UpdateClientLanguage(Request $request)
    {
        $id = $request->get('id');
        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(\stdClass::class,UpdateClientLanguageRequest::class,(object)$data);
        $request->setId($id);

        $result = $this->clientService->UpdateClientLanguage($request);

        return $this->response($result,self::UPDATE);
    }

}
