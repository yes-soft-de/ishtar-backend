<?php


namespace App\Manager;


use App\Entity\ClapEntity;
use App\Mapper\ClapMapper;
use App\Repository\ClapEntityRepository;
use App\Repository\ClientEntityRepository;
use App\Repository\EntityRepository;
use App\Request\CreateClapRequest;
use App\Request\GetClientRequest;
use App\Request\GetEntityRequest;
use App\Request\UpdateClapRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ClapManager
{
    private $entityManager;
    private $clapRepository;
    private $entityRepository;
    private $clientRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,ClapEntityRepository $clapRepository,
                                EntityRepository $entityRepository,ClientEntityRepository $clientRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->clapRepository=$clapRepository;
        $this->entityRepository=$entityRepository;
        $this->clientRepository=$clientRepository;
    }

    public function create(CreateClapRequest $request)
    {

        $config = new AutoMapperConfig();
        $config->registerMapping(CreateClapRequest::class, ClapEntity::class);
        $mapper = new AutoMapper($config);
        $request->setClient($this->clientRepository->find($request->getClient()));
        $request->setEntity($this->entityRepository->find($request->getEntity()));
        $clapData= $mapper->map($request, ClapEntity::class);
        $this->entityManager->persist($clapData);
        $this->entityManager->flush();
        return $clapData;
    }
    public function update(UpdateClapRequest$request)
    {
        $clapEntity=$this->clapRepository->find($request->getId());
        if (!$clapEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("clap");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(UpdateClapRequest::class, ClapEntity::class);
            $mapper = new AutoMapper($config);
            $request->setClient($this->clientRepository->find($request->getClient()));
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $clapEntity = $mapper->mapToObject($request, $clapEntity);
            $this->entityManager->flush();
            return $clapEntity;
        }
    }
    public function getEntityclap(GetEntityRequest $request)
    {
        return $clapResult =$this->clapRepository
            ->getEntityClap($request->getEntity(),$request->getRow());
    }

    public function getClientClap(GetClientRequest $request)
    {
        return $clapResult =$this->clapRepository->getClientClap($request->getClient());
    }
    public function getAll()
    {
        return $clapResult =$this->clapRepository->findAll();
    }
    public function delete(Request $request)
    {
        $clapEntity=$this->clapRepository->find($request->get('id'));
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