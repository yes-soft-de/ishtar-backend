<?php

namespace App\Repository;

use App\Entity\CommentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method CommentEntity[]    findAll()
 * @method CommentEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentEntity::class);
    }

    // /**
    //  * @return CommentEntity[] Returns an array of CommentEntity objects
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

    public function findOneById($value): ?CommentEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findAll():?array
    {
        return $this->createQueryBuilder('q')
            ->select('c.id','c.body','c.date','c.lastEdit','c.spacial','cl.userName','e.name as entity','c.row')
            ->from('App:CommentEntity','c')
            ->from('App:ClientEntity','cl')
            ->from('App:Entity','e')
            ->andWhere('c.client=cl.id')
            ->andWhere('c.entity=e.id')
//            ->andWhere('at.id=ea.artType')
//            ->andWhere('ea.entity=1')
//            ->andWhere('p.id=s.row')
//            ->andWhere('s.entity=1')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }

    public function getEntityComment($entity,$id):?array
    {
        return $this->createQueryBuilder('q')
            ->select('c.id','c.body','c.date','c.spacial','cl.userName')
            ->from('App:CommentEntity','c')
            ->from('App:ClientEntity','cl')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('c.client=cl.id')
            ->andWhere('c.entity='.$entity)
            ->andWhere('c.row='.$id)
//            ->andWhere('m.entity=5')
//            ->andWhere('m.media=1')
//            ->andWhere('m.row=c.id')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }
    public function getClientComment($client):?array
    {
        return $this->createQueryBuilder('q')
            ->select('e.name as entity','c.row as id','c.body','c.date','c.spacial')
            ->from('App:CommentEntity','c')
            ->from('App:Entity','e')
            ->andWhere('c.client='.$client)
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }
}
