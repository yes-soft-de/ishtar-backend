<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtTypeController extends AbstractController
{
    /**
     * @Route("/art/type", name="art_type")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArtTypeController.php',
        ]);
    }
}
