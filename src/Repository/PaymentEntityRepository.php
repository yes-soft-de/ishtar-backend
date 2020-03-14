<?php

namespace App\Repository;

use App\Entity\PaymentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method PaymentEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentEntity[]    findAll()
 * @method PaymentEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentEntity::class);
    }

    // /**
    //  * @return PaymentEntity[] Returns an array of PaymentEntity objects
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


    public function getByPaymentId($value): ?PaymentEntity
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.paymentId = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function getByOrder($value): ?PaymentEntity
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.order = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function getByToken($value): ?PaymentEntity
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.token = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

}
