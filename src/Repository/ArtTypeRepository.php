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


    public function getById($value): ?array
    {
        return $this->createQueryBuilder('at')
            ->select('at.id','at.name','m.path')
            ->from('App:EntityMediaEntity','m')
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
       return $this->createQueryBuilder('at')
           ->select('at.id','at.name','m.path')
           ->from('App:EntityMediaEntity','m')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->getQuery()
           ->getResult();

   }
   public function findAll()
   {
       return $this->createQueryBuilder('at')
           ->select('at.id','at.name','at.history','m.path')
           ->from('App:EntityMediaEntity','m')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->getQuery()
           ->getResult();
   }

}
