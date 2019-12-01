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
        $clapEntity=$this->entityManager->getRepository(ClapEntity::class)->find($request->get('id'));
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
    public function getEntityclap(Request $request)
    {
        return $clapResult =$this->entityManager->getRepository(ClapEntity::class)
            ->getEntityClap($request->get('entity'),$request->get('row'));
    }

    public function getClientClap(Request $request)
    {
        return $clapResult =$this->entityManager->getRepository(ClapEntity::class)
            ->getClientClap($request->get('client'));
    }
    public function getAll()
    {
        return $clapResult =$this->entityManager->getRepository(ClapEntity::class)
            ->findAll();
    }
    public function delete(Request $request)
    {
        $clapEntity=$this->entityManager->getRepository(ClapEntity::class)->find($request->get('id'));
        if (!$clapEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
            $this->entityManager->remove($clapEntity);
            $this->entityManager->flush();
        }
        return $clapEntity;
    }
}