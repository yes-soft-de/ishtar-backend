<?php

namespace App\Controller;

use App\Service\UploadFileService;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadFileController extends AbstractController
{
    const ARTISTIMAGEPATH = '/ImageUploads/ArtistImages/';
    const PANTINGIMAGEPATH = '/ImageUploads/PaintingImages/';
    const CLIENTIMAGEPATH = '/ImageUploads/ClientImages/';
    const STATUEIMAGEPATH = '/ImageUploads/StatueImages/';


    /**
     * @Route("/uploadArtistImage", name="uploadArtistImage")
     * @param Request $request
     * @param UploadFileService $uploadFile
     * @return jsonResponse
     */
    public function uploadArtistImage(Request $request, UploadFileService $uploadFile)
    {
        $this->validation($request);

        $imageFile = $request->files->get('image');

        $path = $uploadFile->upload($imageFile, self::ARTISTIMAGEPATH);


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

        $path = $uploadFile->upload($imageFile, self::PANTINGIMAGEPATH);

        $response = new jsonResponse(["status_code" => "200",
                "url" => $path
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/uploadClientImage", name="uploadClientImage")
     * @param Request $request
     * @param UploadFileService $uploadFile
     * @return JsonResponse
     */
    public function uploadClientImage(Request $request, UploadFileService $uploadFile)
    {
        $this->validation($request);

        $imageFile = $request->files->get('image');

        $path = $uploadFile->upload($imageFile, self::CLIENTIMAGEPATH);

        $response = new jsonResponse(["status_code" => "200",
                "url" => $path
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/uploadStatueImage", name="uploadStatueImage")
     * @param Request $request
     * @param UploadFileService $uploadFile
     * @return JsonResponse
     */
    public function uploadStatueImage(Request $request, UploadFileService $uploadFile)
    {
        $this->validation($request);

        $imageFile = $request->files->get('image');

        $path = $uploadFile->upload($imageFile, self::STATUEIMAGEPATH);

        $response = new jsonResponse(["status_code" => "200",
                "url" => $path
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function validation(Request $request)
    {
        $file = $request->files->get('image');
        if (empty($file))
        {
            return new JsonResponse("No file specified",  Response::HTTP_UNPROCESSABLE_ENTITY,
                ['content-type' => 'text/plain']);
        }
    }
}