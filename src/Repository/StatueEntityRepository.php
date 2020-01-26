<?php

namespace App\Repository;

use App\Entity\EntityMediaEntity;
use App\Entity\StatueEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
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
    public function __construct(ManagerRegistry $registry)
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
    public function getStatue($id)
    {
        try {
            $result=$this->createQueryBuilder('s')
                ->select('s.id','s.name','a.name as artist','s.state','s.height','s.width','s.image','s.keyWord'
                    ,'s.material','s.description','s.style','s.mediums','s.features',
                    's.period','s.weight','s.length','s.active','pr.price')
                ->from('App:PriceEntity','pr')
                ->from('App:ArtistEntity','a')
                ->andWhere('pr.row=s.id')
                ->andWhere('pr.entity=6')
                ->andWhere('a.id=s.artist')
                ->andWhere('s.id= :id')
                ->groupBy('s.id')
                ->getQuery()
                ->setParameter('id',$id)
                ->getResult();
        return $result;
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
            ->select('s.id','s.name','a.name as artist','s.state','s.height','s.width','s.image','s.keyWord'
                ,'s.material','s.description','s.style','s.mediums','s.features',
                's.period','s.weight','s.length','s.active','pr.price')
            ->from('App:PriceEntity','pr')
            ->from('App:ArtistEntity','a')
            ->andWhere('pr.row=s.id')
            ->andWhere('pr.entity=6')
            ->andWhere('a.id=s.artist')
            ->groupBy('s.id')
            ->getQuery()
            ->getResult();
    }
}
