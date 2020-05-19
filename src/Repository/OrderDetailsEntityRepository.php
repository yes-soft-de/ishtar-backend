<?php

namespace App\Repository;

use App\Entity\OrderDetailsEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderDetailsEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetailsEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetailsEntity[]    findAll()
 * @method OrderDetailsEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailsEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetailsEntity::class);
    }

    // /**
    //  * @return OrderDetailsEntity[] Returns an array of OrderDetailsEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderDetailsEntity
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getOrderItems($orderId):array
    {
        return $this->createQueryBuilder('od')
            ->select('od.rowId','e.id as entity')
            ->from('App:entity','e')
            ->andWhere('od.order = :orderId')
            ->andWhere('od.entity=e.id')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getResult()
            ;
    }
}
