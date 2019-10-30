<?php


namespace App\Manager;


use App\Entity\ClapEntity;
use App\Mapper\ClapMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ClapManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $clap = json_decode($request->getContent(),true);
        $clapEntity=new ClapEntity();
        $clapMapper = new ClapMapper();
        $clapData=$clapMapper->clapData($clap,$clapEntity,$this->entityManager);
        $this->entityManager->persist($clapData);
        $this->entityManager->flush();
        return $clapData;
    }
    public function update(Request $request)
    {
        $clap = json_decode($request->getContent(),true);
        $clapEntity=$this->entityManager->getRepository(ClapEntity::class)->find($clap['id']);
        if (!$clapEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("clap");
        }
        else {
            $clapMapper = new clapMapper();
            $clapMapper->clapData($clap,$clapEntity,$this->entityManager);
            $this->entityManager->flush();
            return $clapEntity;
        }
    }
    public function getEntityclap($request)
    {
        $clap = json_decode($request->getContent(),true);
        return $clapResult =$this->entityManager->getRepository(ClapEntity::class)->getEntityClap($clap['entity']
            ,$clap['id']);
    }

    public function getClientClap($request)
    {
        $clap = json_decode($request->getContent(),true);
        return $clapResult =$this->entityManager->getRepository(ClapEntity::class)->getClientClap($clap['client']);
    }
}