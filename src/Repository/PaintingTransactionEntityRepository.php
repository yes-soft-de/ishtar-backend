<?php

namespace App\Repository;

use App\Entity\PaintingTransactionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingTransactionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingTransactionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingTransactionEntity[]    findAll()
 * @method PaintingTransactionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingTransactionEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingTransactionEntity::class);
    }

    // /**
    //  * @return PaintingTransactionEntity[] Returns an array of PaintingTransactionEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaintingTransactionEntity
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
