<?php

namespace App\Repository;

use App\Entity\AuctionClientEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AuctionClientEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuctionClientEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuctionClientEntity[]    findAll()
 * @method AuctionClientEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuctionClientEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuctionClientEntity::class);
    }

    // /**
    //  * @return AuctionClientEntity[] Returns an array of AuctionClientEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuctionClientEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
