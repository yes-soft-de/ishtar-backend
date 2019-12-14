<?php

namespace App\Controller;

use App\Service\StatueService;
use App\Validator\StatueValidateInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StatueController extends BaseController
{
    private $statueService;

    /**
     * StatueController constructor.
     * @param $statueService
     */
    public function __construct(StatueService $statueService)
    {
        $this->statueService = $statueService;
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/statues", name="createStatue",methods={"POST"})
     * @param Request $request
     * @return
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
        $result = $this->statueService->create($request);
       // $this->CUDService->create($request,"StatuePrice");
        return $this->response($result, self::CREATE,"Statue");
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/statue/{id}", name="updateStatue",methods={"PUT"})
     * @param Request $request
     * @return
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
        $result = $this->statueService->update($request);
        return $this->response($result, self::UPDATE,"Statue");
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="access denied")
     *  @Route("/statue/{id}", name="deleteStatue",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request, StatueValidateInterface $statueValidate)
    {
//        $validateResult = $statueValidate->statueValidator($request, 'delete');
//        if (!empty($validateResult))
//        {
//            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
//            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
//            return $resultResponse;
//        }
     //   $this->CUDService->delete($request,"Price");
        $result = $this->statueService->delete($request);

        return $this->response($result, self::DELETE,"Statue");

    }

    /**
     * @Route("/statues", name="getAllStatue",methods={"GET"})
     * @return
     */

    public function getAll()
    {

        $result = $this->statueService->getAll();
        return $this->response($result,self::FETCH,"Statue");
    }

    /**
     * @Route("/statue/{id}", name="getStatueById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getStatueById(Request $request)
    {
        $result = $this->statueService->getStatueById($request->get('id'));
        return $this->response($result,self::FETCH,"Statue");
    }

}
