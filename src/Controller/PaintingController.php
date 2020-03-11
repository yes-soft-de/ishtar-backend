<?php

namespace App\Controller;
use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateArtistRequest;
use App\Request\CreatePaintingRequest;
use App\Request\DeleteRequest;
use App\Request\getPaintingByRequest;
use App\Request\UpdateFeaturedPaintingsRequest;
use App\Request\UpdatePaintingRequest;
use App\Service\ImageResolveService;
use App\Service\PaintingService;
use App\Validator\PaintingValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingController extends BaseController
{
    private $paintingService;
    private $autoMapping;
    private $imageResolve;

    /**
     * PaintingController constructor.
     * @param PaintingService $paintingService
     */
    public function __construct(PaintingService $paintingService, AutoMapping $autoMapping, ImageResolveService $imageResolve)
    {
        $this->paintingService=$paintingService;
        $this->autoMapping=$autoMapping;
        $this->imageResolve = $imageResolve;
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/paintings", name="createPainting",methods={"POST"})
     * @param Request $request
     * @param PaintingValidateInterface $paintingValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function create(Request $request, PaintingValidateInterface $paintingValidate)
    {
        $validateResult = $paintingValidate->paintingValidator($request, 'create');

        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }

        $data = json_decode($request->getContent(), true);

        $request=$this->autoMapping->map(\stdClass::class,CreatePaintingRequest::class,(object)$data);

        //make thumb and add resolved image path to request
        $request->setThumbImage($this->imageResolve->makeThumb($request->getImage()));

        $result = $this->paintingService->create($request);

        return $this->response($result, self::CREATE);
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/painting/{id}", name="updatePainting",methods={"PUT"})
     * @param Request $request
     * @param PaintingValidateInterface $paintingValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function update(Request $request, PaintingValidateInterface $paintingValidate)
    {
        $validateResult = $paintingValidate->paintingValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdatePaintingRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->paintingService->update($request,$id);
        return $this->response($result, self::UPDATE);
    }

    /**
     *  @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/painting/{id}", name="deletePainting",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
   {
        $request=new DeleteRequest($request->get('id'));
       $result=$this->paintingService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/paintings", name="getAllPainting",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        //$request->getPreferredLanguage();

        $result = $this->paintingService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/painting/{id}", name="getPaintingById",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaintingById(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->paintingService->getPaintingById($request->getId());
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/paintingby/{parm}/{value}", name="getPaintingBy",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getBy(Request $request)
    {
        $request=new GetPaintingByRequest($request->get('parm'),$request->get('value'));
        $result = $this->paintingService->getBy($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/featuredpaintings", name="getfeaturedpaintings",methods={"GET"})
     * @return JsonResponse
     */
    public function getAllFeaturedPaintings()
    {
        $result = $this->paintingService->getAllFeaturedPaintings();
        return $this->response($result,self::FETCH);
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="access denied")
     * @Route("/featuredpainting/{id}/{isFeatured}", name="featuredpainting",methods={"PUT"})
     * @param Request $request
     * @param PaintingValidateInterface $paintingValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function updateFeaturedPaintings(Request $request)
    {
        $id = $request->get('id');
        $isFeatured =$request->get('isFeatured');

        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(\stdClass::class,UpdateFeaturedPaintingsRequest::class,(object)$data);
        $request->setId($id);
        $request->setIsFeatured($isFeatured);

        $result = $this->paintingService->updateFeaturedPaintings($request);

        return $this->response($result, self::UPDATE);
    }

}
