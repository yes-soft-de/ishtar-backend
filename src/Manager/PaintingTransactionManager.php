<?php


namespace App\Manager;



use App\Entity\PaintingTransactionEntity;
use App\Mapper\PaintingTransactionMapper;
use App\Mapper\AutoMapper;
use App\Repository\PaintingTransactionEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class PaintingTransactionManager
{
    private $entityManager;
    private $paintingTransactionRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,
                                PaintingTransactionEntityRepository $paintingTransactionRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->paintingTransactionRepository=$paintingTransactionRepository;
    }

    public function create(Request $request)
    {
        $paintingTransaction = json_decode($request->getContent(),true);
        $paintingTransactionEntity=new PaintingTransactionEntity();
        $paintingTransactionMapper = new PaintingTransactionMapper();
        $paintingTransactionData=$paintingTransactionMapper->paintingTransactionData($paintingTransaction, $paintingTransactionEntity);
        $this->entityManager->persist($paintingTransactionData);
        $this->entityManager->flush();
        return $paintingTransactionData;
    }
    public function update(Request $request)
    {
        $paintingTransaction = json_decode($request->getContent(),true);
        $paintingTransactionEntity=$this->paintingTransactionRepository->getPaintingTransaction($request->get('id'));
        if (!$paintingTransactionEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("paintingTransaction");
        }
        else {
            $paintingTransactionMapper = new PaintingTransactionMapper();
            $paintingTransactionMapper->PaintingTransactionData($paintingTransaction, $paintingTransactionEntity);
            $this->entityManager->flush();
            return $paintingTransactionEntity;
        }
    }
    public function delete(Request $request)
    {
        $paintingTransaction=$this->paintingTransactionRepository->getPaintingTransaction($request->get('id'));
        $this->entityManager->remove($paintingTransaction);
        $this->entityManager->flush();
        return $paintingTransaction;
    }
    public function getAll()
    {
        $data=$this->paintingTransactionRepository->getAll();

        return $data;
    }

    public function getById(Request $request)
    {
        return $result = $this->paintingTransactionRepository->find($request->get('id'));
    }
    public function getAllDetails()
    {
        $data=$this->paintingTransactionRepository->getAllDetails();

        return $data;
    }
}
