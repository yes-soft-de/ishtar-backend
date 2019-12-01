<?php

namespace App\Repository;

use App\Entity\StatueEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatueEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatueEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatueEntity[]    findAll()
 * @method StatueEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatueEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatueEntity::class);
    }

    // /**
    //  * @return StatueEntity[] Returns an array of StatueEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatueEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @method getStatue
     * @param $id
     * @return StatueEntity
     *
     */
    public function getStatue($id):StatueEntity
    {
        try {
            return $this->createQueryBuilder('s')
                ->andWhere('s.id=:id')
                ->groupBy('s.id')
                ->getQuery()
                ->setParameter('id',$id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    /**
     * @method getAllStatue
     * @param
     * @return StatueEntity[]
     *
     */
    public function getAll():?array
    {
        return $this->createQueryBuilder('s')
            ->select('s','pr.price')
            ->from('App:PriceEntity','pr')
            ->andWhere('pr.row=s.id')
            ->andWhere('pr.entity=6')
            ->groupBy('s.id')
            ->getQuery()
            ->getResult();
    }
}
