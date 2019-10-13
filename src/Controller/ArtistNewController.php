<?php

namespace App\Controller;
use App\Request\CreateArtistRequest;
use App\Request\UpdateArtistRequest;
use App\Service\ArtistService;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ArtistValidateInterface;

class ArtistNewController extends BaseController
{
    private $artistService;
    /**
     * ArtistNewController constructor.
     */
    public function __construct(ArtistService $artistService)
    {
        $this->artistService=$artistService;
    }
    /**
     * @Route("/artists", name="createArtist",methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception

     */
    public function create(Request $request,ArtistValidateInterface $artistValidate)
    {
        //Validation
        $validateResult = $artistValidate->artistValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(),true);
        $artist=new CreateArtistRequest();
       $artist=$this->fillRequestData($data,$artist);
        $result=$this->artistService->create($artist);
        return $this->response($result,self::CREATE);
    }
    /**
     * @Route("/artist/{id}", name="updateNewArtist",methods={"PUT"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function update(Request $request,$id)
    {
        $data = json_decode($request->getContent(),true);
        $artist=new UpdateArtistRequest();
        $artist=$this->fillRequestData($data,$artist);
        $artist->setId($id);
        $result=$this->artistService->update($artist);
        return $this->response($result,self::UPDATE);
    }
    /**
     * @Route("/artist/{id}", name="deleteArtist",methods={"DELETE"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function delete($id)
    {
        $result=$this->artistService->delete($id);
        return $this->response($result,self::DELETE);
    }
    public function fillRequestData($data,$artist)
    {
        $artist->setName($data['name']);
        $artist->setResidence($data['residence']);
        $artist->setNationality($data['nationality']);
        $artist->setStory($data['story']);
        $artist->setFacebook($data['Facebook']);
        $artist->setBirthDate(new DateTime((string)$data['birthDate']));
        $artist->setTwitter($data['Twitter']);
        $artist->setLinkedin($data['Linkedin']);
        $artist->setArtType($data['artType']);
        return $artist;
    }
    //request to object req
    //validate
    //artist service update
    //return update response
}
