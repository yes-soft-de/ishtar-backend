<?php

namespace App\Repository;

use App\Entity\ArtistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArtistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ArtistEntity[]    findAll()
 * @method ArtistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtistEntity::class);
    }

    /**
      * @return ArtistEntity[] Returns an array of ArtistEntity objects
     */

    public function findById($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.Id = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ArtistEntity[] Returns an array of ArtistEntity objects
     */
    public function findOneById($value): ?ArtistEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->select('at.id','at.name','m.path')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','at')
            ->andWhere('at.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->groupBy('at.id')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
    public function getArtistsData($request)
    {
        return $this->createQueryBuilder('p')
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story','sm.address','a.story','m.path')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            ->from('App:SocialMediaArtistEntity','sm')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('sm.artist=a.id')
            ->groupBy('a.id')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
}
