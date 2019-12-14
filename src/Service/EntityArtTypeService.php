<?php


namespace App\Service;


use App\Manager\PaintingManager;
use Doctrine\ORM\EntityManagerInterface;

class EntityArtTypeService
{
    private $Manager;

    public function __construct(PaintingManager $manager)
    {
        $this->Manager=$manager;
    }

    public function create($painting,$entity)
    {
        $result =$this->Manager->create($painting,$entity);
        return $result;
    }
//    //ToDO mapping painting entity and response
//    public function update($painting):UpdatePaintingResponse
//    {
//        $updatePaintingResponse =new UpdatePaintingResponse();
//        $result =$this->Paintingmanager->update($painting);
//        $result=$this->autoMapper->Map($result,$updatePaintingResponse);
//        return $result;
//    }
//    public function getAll()
//    {
//        $result=$this->Paintingmanager->getAll();
//        return $result;
//    }
}