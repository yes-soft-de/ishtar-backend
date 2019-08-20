<?php

namespace App\Repository;

use App\Entity\InteractionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InteractionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method InteractionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method InteractionEntity[]    findAll()
 * @method InteractionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InteractionEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InteractionEntity::class);
    }

    // /**
    //  * @return InteractionEntity[] Returns an array of InteractionEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneById($value): ?InteractionEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}