<?php

namespace App\Controller;

use App\Mapper\AutoMapper;
use App\Service\ArtistService;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ArtistValidateInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;

//use Symfony\Component\Validator\Constraints\Date;

class ArtistNewController
{
    private $entityManager;
    /**
     * ArtistNewController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    /**
     * @Route("/createNewArtist", name="createNewArtist")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $artistService=new ArtistService($this->entityManager);
        $data = json_decode($request->getContent(),true);
        $artist=new Artist();
        $artist->setName($data['name']);
        $artist->setResidence($data['residence']);
        $artist->setNationality($data['nationality']);
        $artist->setStory($data['story']);
        $artist->setFacebook($data['Facebook']);
       $artist->setBirthDate(new DateTime((string)$data['birthDate']));
        $artist->setTwitter($data['Twitter']);
        $artist->setLinkedin($data['Linkedin']);
        //this instruction return null
      //  $artist->setTwitter($request->request->get('Twitter'));
        $result=$artistService->create($artist);
        $encoders = [ new JsonEncoder(),new XmlEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $result = $serializer->serialize($result, "json");
        $response = new jsonResponse(["status_code" => "200",
                "msg" =>  "1 "."Successfully.",
                "Data" => json_decode($result)
            ]
            , Response::HTTP_OK);
        return $response;
    }


}
Class Artist
{
    public $id;
    public $name;
    public $nationality;
    public $residence;
    public $story;
    public $details;
    public $gallery;
    public $createdBy;
    public $createDate;
    public $updatedBy;
    public $updateDate;
    public $Facebook;
    public $Twitter;
    public $Linkedin;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    public $Instagram;
    public $birthDate;

    /**
     * @return mixed
     */
    public function getBirthDate():\DateTimeInterface
    {
        return $this->birthDate;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate(?\DateTimeInterface $birthDate): void
    {
        $this->birthDate =$birthDate;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @param mixed $residence
     */
    public function setResidence($residence): void
    {
        $this->residence = $residence;
    }


    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param mixed $story
     */
    public function setStory($story): void
    {
        $this->story = $story;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery
     */
    public function setGallery($gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param mixed $updateDate
     */
    public function setUpdateDate($updateDate): void
    {
        $this->updateDate = $updateDate;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->Facebook;
    }

    /**
     * @param mixed $Facebook
     */
    public function setFacebook($Facebook): void
    {
        $this->Facebook = $Facebook;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->Twitter;
    }

    /**
     * @param mixed $Twitter
     */
    public function setTwitter($Twitter): void
    {
        $this->Twitter = $Twitter;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->Linkedin;
    }

    /**
     * @param mixed $Linkedin
     */
    public function setLinkedin($Linkedin): void
    {
        $this->Linkedin = $Linkedin;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->Instagram;
    }

    /**
     * @param mixed $Instagram
     */
    public function setInstagram($Instagram): void
    {
        $this->Instagram = $Instagram;
    }

}
