<?php

namespace App\Repository;

use App\Entity\PriceEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PriceEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceEntity[]    findAll()
 * @method PriceEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceEntity::class);
    }

    // /**
    //  * @return PriceEntity[] Returns an array of PriceEntity objects
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


    public function findEntity($value,$entity)
    {
        $result= $this->createQueryBuilder('pr')
            ->andWhere('pr.entity =:entity')
            ->andWhere('pr.row=:val')
            ->setParameter('val', $value)
            ->setParameter('entity',$entity)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
        return $result;
    }

}
