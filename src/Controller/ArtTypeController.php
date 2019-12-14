<?php

namespace App\Controller;

use App\Service\ArtTypeService;
use App\Validator\ArtTypeValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ArtTypeController extends BaseController
{
    private $artTypeService;
    /**
     * ArtistController constructor.
     */
    public function __construct(ArtTypeService $artTypeService)
    {
        $this->artTypeService=$artTypeService;
    }
    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/arttypes", name="createArtType",methods={"POST"})
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

        $result = $this->artTypeService->create($request);
        return $this->response($result, self::CREATE,"ArtType");
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/arttype/{id}", name="updateArttype",methods={"PUT"})
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
        $result = $this->artTypeService->update($request);
        return $this->response($result, self::UPDATE, "ArtType");
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     *  @Route("/arttype/{id}", name="deleteArtType",methods={"DELETE"})
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
        $result = $this->artTypeService->delete($request);
        return $this->response($result, self::DELETE, "ArtType");

    }
    /**
     * @Route("/arttypes", name="getAllArtTYpe",methods={"GET"})
     * @return
     */
    public function getAll(Request $request)
    {
        $result = $this->artTypeService->getAll();
        return $this->response($result,self::FETCH,"ArtType");
    }

    /**
     * @Route("/arttype/{id}", name="getArtTypeById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getArtTypeById(Request $request)
    {
        $result = $this->artTypeService->getArtTypeById($request);
        return $this->response($result,self::FETCH,"ArtType");
    }

    }
