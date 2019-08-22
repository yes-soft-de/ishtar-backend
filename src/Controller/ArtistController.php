<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends BaseController
{
    /**
     * @Route("/createArtist", name="createArtist")
     * @param Request $request
     * @return
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->create($request, "Artist");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateArtist", name="updateArtist")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "Artist");
        return $result;
    }

    /**
     * @Route("/deleteArtist", name="deleteArtist")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "Artist");
        return $result;
    }
}
