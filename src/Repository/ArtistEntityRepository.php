<?php

namespace App\Repository;

use App\Entity\ArtistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArtistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistEntity[]    findAll()
 * @method ArtistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtistEntity::class);
    }

    // /**
    //  * @return ArtistEntity[] Returns an array of ArtistEntity objects
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
    public function findOneBySomeField($value): ?ArtistEntity
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
