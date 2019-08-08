<?php

namespace App\Repository;

use App\Entity\ArtistArtTypeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArtistArtTypeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistArtTypeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistArtTypeEntity[]    findAll()
 * @method ArtistArtTypeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistArtTypeEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtistArtTypeEntity::class);
    }

    // /**
    //  * @return ArtistArtTypeEntity[] Returns an array of ArtistArtTypeEntity objects
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
    public function findOneBySomeField($value): ?ArtistArtTypeEntity
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
