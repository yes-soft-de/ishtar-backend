<?php

namespace App\Repository;

use App\Entity\Entity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]    findAll()
 * @method Entity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entity::class);
    }
    public function getEntityItems($entity)
    {
        if ($entity=='Client')
            $name='e.username as name';
        else $name='e.name';
        $entity = 'App:' . $entity .'Entity';
        return $this->createQueryBuilder('p')
            ->select('e.id',$name)
            ->from($entity,'e')
            ->groupBy('e.id')
            ->getQuery()
            ->getResult();
    }
}
