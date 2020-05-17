<?php

namespace App\Repository;

use App\Entity\OrderEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method OrderEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderEntity[]    findAll()
 * @method OrderEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderEntity::class);
    }

    // /**
    //  * @return OrderEntity[] Returns an array of OrderEntity objects
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

    public function findOrderByPayment($value): ?OrderEntity
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.paymentId = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function getAll()
    {
        return $this->createQueryBuilder('o')
            ->getQuery()
            ->getResult();
    }
    public function getClientOrders($client)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('c.id= :client')
            ->andWhere('o.client=c.id')
            ->from('App:ClientEntity','c')
            ->setParameter('client',$client)
            ->getQuery()
            ->getResult();
    }

}
