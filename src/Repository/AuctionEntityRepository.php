<?php

namespace App\Repository;

use App\Entity\AuctionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuctionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuctionEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method AuctionEntity[]    findAll()
 * @method AuctionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuctionEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuctionEntity::class);
    }

    // /**
    //  * @return AuctionEntity[] Returns an array of AuctionEntity objects
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

    public function findOneById($value): ?AuctionEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findAll()
    {
        return $this->createQueryBuilder('q')
            ->select('a.id','a.name','a.startDate','a.endDate','ap.startPrice','ap.finalPrice','ap.highiestPrice',
                'c.firstName','p.name')
            ->from('App:AuctionEntity','a')
            ->from('App:PaintingEntity','p')
            ->from('App:ClientEntity','c')
            ->from('App:AuctionPaintingEntity','ap')
            ->andWhere('a.id=ap.auction')
           // ->andWhere('c.id=ap.client')
            ->andWhere('p.id=ap.painting')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }
}
