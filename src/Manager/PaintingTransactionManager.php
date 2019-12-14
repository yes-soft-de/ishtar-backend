<?php


namespace App\Manager;



use App\Entity\PaintingTransactionEntity;
use App\Mapper\PaintingTransactionMapper;
use App\Mapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class PaintingTransactionManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
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
        $paintingTransactionEntity=$this->entityManager->getRepository(PaintingTransactionEntity::class)->getPaintingTransaction($request->get('id'));
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
        $paintingTransaction=$this->entityManager->getRepository(PaintingTransactionEntity::class)->getPaintingTransaction($request->get('id'));
        $this->entityManager->remove($paintingTransaction);
        $this->entityManager->flush();
        return $paintingTransaction;
    }
    public function getAll()
    {
        $data=$this->entityManager->getRepository(PaintingTransactionEntity::class)->getAll();

        return $data;
    }

    public function getById(Request $request)
    {
        return $result = $this->entityManager->getRepository(PaintingTransactionEntity::class)->findById($request->get('id'));
    }
    public function search(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return $result = $this->entityManager->getRepository(PaintingTransactionEntity::class)->search($data['keyword']);
    }
    public function getAllDetails()
    {
        $data=$this->entityManager->getRepository(PaintingTransactionEntity::class)->getAllDetails();

        return $data;
    }
}
