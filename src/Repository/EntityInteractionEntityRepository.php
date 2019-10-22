<?php

namespace App\Repository;

use App\Entity\EntityInteractionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EntityInteractionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntityInteractionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntityInteractionEntity[]    findAll()
 * @method EntityInteractionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntityInteractionEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityInteractionEntity::class);
    }

    // /**
    //  * @return EntityInteractionEntity[] Returns an array of EntityInteractionEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EntityInteractionEntity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getInteraction($entity,$row,$interaction)
    {
        return $this->createQueryBuilder('q')
            ->select('count (q) as interactions')
           // ->from('App:EntityInteractionEntity','ei')
            ->from('App:ClientEntity','c')
            ->andWhere('q.entity='.$entity)
            ->andWhere('q.row='.$row)
            ->andWhere('q.interaction='.$interaction)
            ->andWhere('c.id=q.client')
           // ->orWhere('q.client IS Null')
           // ->distinct('q.id')
          //  ->groupBy('q.')
            ->getQuery()
            ->getResult();
    }
    public function getClientInteraction($client):?array
    {
        return $this->createQueryBuilder('q')
            ->select('e.name as entity', 'ei.row as id','i.name as interaction','ei.id as interactionID')
            ->from('App:EntityInteractionEntity', 'ei')
            ->from('App:Entity', 'e')
            ->from('App:InteractionEntity', 'i')
            ->andWhere('ei.client=' . $client)
            ->andWhere('ei.entity=e.id')
            ->andWhere('ei.interaction=i.id')
            ->groupBy('ei.id')
            ->getQuery()
            ->getResult();
    }
}
