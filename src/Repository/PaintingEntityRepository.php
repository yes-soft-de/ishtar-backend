<?php

namespace App\Repository;

use App\Entity\EntityArtTypeEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\PaintingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingEntity[]    findAll()
 * @method PaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingEntity::class);
    }

    public function findOneById($value): ?array
    {
        $result = $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.keyWords','p.state','p.height','p.width','p.colorsType','p.image'
                ,'p.active','a.name as artist','s.story')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:StoryEntity','s')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=s.row')
            ->andWhere('p.id = :val')
            ->andWhere('s.entity=1')
            ->groupBy('p.id')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    $result=array_merge($result,$this->getEntityManager()->getRepository
    (EntityArtTypeEntity::class)->getPaintingArtTypes($value));
    $result=array_merge($result,$this->getEntityManager()->getRepository(EntityMediaEntity::class)->findPaintingImage($value));
        return $result;
    }

    public function getAll():?array
    {
        return $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.state','p.height','p.width','p.colorsType','p.image','p.active',
               'p.keyWords', 'a.name as artist','at.name as artType','s.story')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','ea')
            ->from('App:StoryEntity','s')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=ea.row')
            ->andWhere('at.id=ea.artType')
            ->andWhere('ea.entity=1')
            ->andWhere('p.id=s.row')
            ->andWhere('s.entity=1')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }
    public function getBy($parm,$value):?array
    {
        $parm = "p." . $parm . "='" . $value . "'";

        return $this->createQueryBuilder('q')
            ->select('p.id', 'p.name', 'p.keyWords', 'p.state', 'p.height', 'p.width', 'p.colorsType', 'p.image',
                'p.active', 'a.name as artist', 'at.name as artType')
            ->from('App:PaintingEntity', 'p')
            ->from('App:ArtistEntity', 'a')
            ->from('App:ArtTypeEntity', 'at')
            ->from('App:EntityArtTypeEntity', 'ea')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=ea.row')
            ->andWhere('at.id=ea.artType')
            ->andWhere('ea.entity=1')
            ->andWhere($parm)
            ->orderBy('p.id', 'ASC')
            ->groupBy('p.name')
            ->getQuery()
            ->getResult();

    }

    public function getPaintingShort():?array
    {
        return $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.image','p.height','p.width','a.name as artist','at.name as artType')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:EntityArtTypeEntity','ea')
            ->from('App:ArtTypeEntity','at')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=ea.row')
            ->andWhere('ea.entity=1')
            ->andWhere('ea.artType=at.id')
            ->groupBy('p.id')
           // ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }

}
