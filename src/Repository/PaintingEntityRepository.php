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
 //* @method PaintingEntity[]    findAll()
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
        if($parm=='artType')
            $parm='ea.artType='.$value;
        else
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

    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->select('a.id','a.name','count(p) as painting','at.name as artType','m.path as image')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            //->from('App:PaintingEntity','p')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','ea')
           // ->from('App:EntityInteractionEntity','ei')
           ->distinct('p.id')
            ->Where('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('at.id=ea.artType')
            ->andWhere('p.artist=a.id')
            ->andWhere('ea.entity=2')
            ->andWhere('a.id=ea.row')
            //->andWhere('ei.entity=2')
            //->andWhere('ei.interaction=3')
            // ->andWhere('ei.row=a.id')
            ->groupBy('a.id')
           // ->orderBy('a.id')
            ->getQuery()
            ->getResult();
    }


}
