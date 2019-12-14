<?php

namespace App\Repository;

use App\Entity\PaintingTransactionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingTransactionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingTransactionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingTransactionEntity[]    findAll()
 * @method PaintingTransactionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingTransactionEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaintingTransactionEntity::class);
    }

    // /**
    //  * @return PaintingTransactionEntity[] Returns an array of PaintingTransactionEntity objects
    //  */

    public function findOneById($value)
    {
        return $this->createQueryBuilder('pt')
            ->andWhere('pt.id = :val')
            ->setParameter('val', $value)
            ->orderBy('pt.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

}
