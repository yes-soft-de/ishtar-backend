<?php


namespace App\Service;

use App\Controller\Artist;
use App\Manager\ArtistArtTypeManager;
use App\Manager\ArtistManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Mapper\AutoMapper;
use App\Response\CreateArtistResponse;
use App\Response\UpdateArtistResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\Tests\Fixtures\TypeHinted;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ArtistService
{
//must use TypeHInt
    private $Artistmanager;
    private $autoMapper;
    private $ArtistArtTypeManger;

    public function __construct(ArtistManager $artistManager,AutoMapper $autoMapper,ArtistArtTypeManager $artistArtTypeManager)
    {
        $this->Artistmanager=$artistManager;
        $this->autoMapper=$autoMapper;
        $this->ArtistArtTypeManger=$artistArtTypeManager;
    }

    public function create($artist):CreateArtistResponse
    {
        $createArtistResponse =new CreateArtistResponse();
         $result =$this->Artistmanager->create($artist);
         $this->ArtistArtTypeManger->create($artist);
         $result= $this->autoMapper->Map($result,$createArtistResponse);
        return $result;
    }
    //ToDO mapping artist entity and response
    public function update($artist):UpdateArtistResponse
    {
        $updateArtistResponse =new UpdateArtistResponse();
        $result =$this->Artistmanager->update($artist);
        $result=$this->autoMapper->Map($result,$updateArtistResponse);
        return $result;
    }
}