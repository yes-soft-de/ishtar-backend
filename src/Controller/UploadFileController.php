<?php

namespace App\Controller;

use App\Service\UploadFileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadFileController extends AbstractController
{
    //ToDo: move const to baseController
    const ARTISTIMAGEPATH = '/public/uploads/ArtistImages/';
    const PANTINGIMAGEPATH = '/public/uploads/PantingImages';

    /**
     * @Route("/uploadArtistImage", name="uploadArtistImage")
     * @param Request $request
     * @param UploadFileService $uploadFile
     * @return
     */
    public function uploadArtistImage(Request $request, UploadFileService $uploadFile)
    {
        $this->validation($request);

        $imageFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').self::ARTISTIMAGEPATH;

        $path = $uploadFile->upload($imageFile, $destination);


        $response = new jsonResponse(["status_code" => "200",
                "url" => $path
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/uploadPaintingImage", name="uploadPaintingImage")
     * @param Request $request
     * @param UploadFileService $uploadFile
     * @return JsonResponse
     */
    public function uploadPaintingImage(Request $request, UploadFileService $uploadFile)
    {
        $this->validation($request);

        $imageFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').self::PANTINGIMAGEPATH;

        return new JsonResponse($uploadFile->upload($imageFile, $destination));
    }

    public function validation(Request $request)
    {
        /*
        $token = $request->get("token");

        if (!$this->isCsrfTokenValid('upload', $token))
        {
            return new JsonResponse("Operation not allowed",  Response::HTTP_BAD_REQUEST,
                ['content-type' => 'text/plain']);
        } */

        $file = $request->files->get('image');
        if (empty($file))
        {
            return new JsonResponse("No file specified",  Response::HTTP_UNPROCESSABLE_ENTITY,
                ['content-type' => 'text/plain']);
        }
    }
}
