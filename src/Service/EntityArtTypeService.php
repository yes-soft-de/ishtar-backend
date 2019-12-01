<?php


namespace App\Service;


use App\Manager\PaintingManager;
use Doctrine\ORM\EntityManagerInterface;

class EntityArtTypeService
{
    private $Manager;

    public function __construct(PaintingManager $manager)
    {
        $this->Manager = $manager;
    }

    public function create($painting, $entity)
    {
        $result = $this->Manager->create($painting, $entity);
        return $result;
    }
}