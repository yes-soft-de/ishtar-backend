<?php

namespace App\Repository;

use App\Entity\ClientEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClientEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ClientEntity[]    findAll()
 * @method ClientEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClientEntity::class);
    }

    // /**
    //  * @return ClientEntity[] Returns an array of ClientEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findClient($value): ?ClientEntity
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function findAll()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive=1')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }


}
