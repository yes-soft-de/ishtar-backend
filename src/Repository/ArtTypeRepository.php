<?php

namespace App\Repository;

use App\Entity\ArtTypeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArtTypeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtTypeEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ArtTypeEntity[]    findAll()
 * @method ArtTypeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtTypeEntity::class);
    }

    // /**
    //  * @return ArtType[] Returns an array of ArtType objects
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

    public function getById($value): ?array
    {
        return $this->createQueryBuilder('q')
            ->select('at.id','at.name','m.path')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtTypeEntity','at')
            ->andWhere('at.id=m.row')
            ->andWhere('m.entity=3')
            ->andWhere('m.media=1')
            ->andWhere('at.id = :val')
            ->setParameter('val', $value)
            ->groupBy('at.id')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
 public function  getArtTypeList()
   {
       return $this->createQueryBuilder('p')
           ->select('at.id','at.name','m.path')
           ->from('App:EntityMediaEntity','m')
           ->from('App:ArtTypeEntity','at')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->setMaxResults(100)
           ->getQuery()
           ->getResult();

   }
   public function findAll()
   {
       return $this->createQueryBuilder('p')
           ->select('at.id','at.name','at.history','m.path')
           ->from('App:EntityMediaEntity','m')
           ->from('App:ArtTypeEntity','at')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->setMaxResults(100)
           ->getQuery()
           ->getResult();
   }
   public function getEntityNames($entity)
   {
       if ($entity=='Client')
           $name='a.userName';
       else $name='a.name';
       $entity = 'App:' . $entity . 'Entity';
       return $this->createQueryBuilder('p')
           ->select('a.id',$name)
           ->from($entity,'a')
           ->setMaxResults(100)
           ->groupBy('a.id')
           ->getQuery()
           ->getResult();
   }
}
