<?php

namespace App\Repository;

use App\Entity\ArtistEntity;
use App\Entity\EntityArtTypeEntity;
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



    public function findById($value)
    {
        $result=$this->createQueryBuilder('c')
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story',
                'a.Facebook','a.Twitter','a.Instagram','a.Linkedin','m.path')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            ->andWhere('a.id = :val')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->setParameter('val', $value)
            ->orderBy('a.name')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
        $result=array_merge($result,$this->getEntityManager()->getRepository
        (EntityArtTypeEntity::class)->getArtistArtTypes($value));
        return $result;
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
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story',
                'a.story','m.path','at.name as artType')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','ea')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('at.id=ea.artType')
            ->andWhere('ea.entity=2')
            ->andWhere('a.id=ea.row')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }
}
