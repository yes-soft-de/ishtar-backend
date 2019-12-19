<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateStatueRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateStatueRequest;
use App\Service\StatueService;
use App\Validator\StatueValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatueController extends BaseController
{
    private $statueService;
    private $autoMapping;

    /**
     * StatueController constructor.
     * @param $statueService
     */
    public function __construct(StatueService $statueService,AutoMapping $autoMapping)
    {
        $this->statueService = $statueService;
        $this->autoMapping=$autoMapping;
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/statues", name="createStatue",methods={"POST"})
     * @param Request $request
     * @param StatueValidateInterface $statueValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function create(Request $request, StatueValidateInterface $statueValidate)
    {
        // Validation
        $validateResult = $statueValidate->statueValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateStatueRequest::class,(object)$data);
        $result = $this->statueService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/statue/{id}", name="updateStatue",methods={"PUT"})
     * @param Request $request
     * @param StatueValidateInterface $statueValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function update(Request $request, StatueValidateInterface $statueValidate)
    {
        $validateResult = $statueValidate->statueValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateStatueRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->statueService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/statue/{id}", name="deleteStatue",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->statueService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/statues", name="getAllStatue",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->statueService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/statue/{id}", name="getStatueById",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getStatueById(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->statueService->getStatueById($request);
        return $this->response($result,self::FETCH);
    }
}
