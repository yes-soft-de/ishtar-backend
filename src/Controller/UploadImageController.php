<?php

namespace App\Controller;

use App\Service\UploadFileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadImageController extends AbstractController
{
    /**
     * @Route("/upload/image", name="upload_image")
     */
    public function index(Request $request, UploadFileService $uploadFile)
    {
        $imageFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

        return new JsonResponse($uploadFile->upload($imageFile, $destination));
    }
}
