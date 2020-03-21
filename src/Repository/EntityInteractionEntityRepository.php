<?php

namespace App\Repository;

use App\Entity\EntityInteractionEntity;
use App\EventListener\LocaleListener;
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
    private $locale;

    public function __construct(ManagerRegistry $registry, LocaleListener $localeListener)
    {
        parent::__construct($registry, EntityInteractionEntity::class);

        if (null == $localeListener->getLocale())
        {
            $this->locale = "en";
        }
        else
        {
            $this->locale = $localeListener->getLocale();
        }
    }

    public function getInteraction($entity,$row,$interaction)
    {
        if($interaction!=3)
        return $this->createQueryBuilder('ei')
            ->select('count (ei) as interactions')
            ->from('App:ClientEntity','c')
            ->andWhere('ei.entity=:entity')
            ->andWhere('ei.row=:row')
            ->andWhere('ei.interaction=:interaction')
            ->andWhere('c.id=ei.client')
            ->setParameter('entity',$entity)
            ->setParameter('row',$row)
            ->setParameter('interaction',$interaction)
            ->getQuery()
            ->getResult();
        else
            {
                return $this->createQueryBuilder('ei')
                    ->select('count (ei) as interactions')
                    //->from('App:ClientEntity','c')
                    ->andWhere('ei.entity=:entity')
                    ->andWhere('ei.row=:row')
                    ->andWhere('ei.interaction=:interaction')
                    //->andWhere('c.id=ei.client OR ei.client IS NULL')
                    ->setParameter('entity',$entity)
                    ->setParameter('row',$row)
                    ->setParameter('interaction',$interaction)
                    ->getQuery()
                    ->getResult();
        }
    }

    public function getClientInteraction($client):?array
    {
        return $this->createQueryBuilder('ei')
            ->select('e.name as entity', 'ei.row as id','i.name as interaction','ei.id as interactionID','ei.date')
            ->from('App:Entity', 'e')
            ->from('App:InteractionEntity', 'i')
            ->andWhere('ei.client=:client')
            ->andWhere('ei.entity=e.id')
            ->andWhere('ei.interaction=i.id')
            ->setParameter('client',$client)
            ->groupBy('ei.id')
            ->getQuery()
            ->getResult();
    }

    public function getAll():?array
    {
        $q1= $this->createQueryBuilder('ei')
            ->select('ei.id', 'e.name as entity','ei.row ','i.name as interaction','c.id as client')
            ->from('App:Entity', 'e')
            ->from('App:InteractionEntity', 'i')
            ->from('App:ClientEntity','c')
            ->andWhere('ei.client=c.id')
            ->andWhere('ei.interaction != 3')
            ->andWhere('ei.entity=e.id')
            ->andWhere('ei.interaction=i.id')
            ->groupBy('ei.id')
            ->getQuery()
            ->getResult();
        $q2=$this->createQueryBuilder('ei')
            ->select('ei.id', 'e.name as entity','ei.row ','i.name as interaction')
            ->from('App:Entity', 'e')
            ->from('App:InteractionEntity', 'i')
            ->andWhere('ei.interaction = 3')
            ->andWhere('ei.entity=e.id')
            ->andWhere('ei.interaction=i.id')
            ->groupBy('ei.id')
            ->getQuery()
            ->getResult();

        return array_merge($q1,$q2);
    }

    public function getEntityInteraction($entity,$id):?array
    {
        return $this->createQueryBuilder('ei')
            ->select('ei')
            ->andWhere('ei.entity=:entity')
            ->andWhere('ei.row=:row')
            ->setParameter('entity',$entity)
            ->setParameter('row',$id)
            ->getQuery()
            ->getResult();
    }

    private function getMostViewPaintings():? array
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        $q1 = $this->createQueryBuilder('ei')
            ->select('p.id','p.name','p.thumbImage as image','p.width',
                'p.height','p.colorsType','a.name as artist', 'a.id as artistID', 'count(p) as viewed','e.name as entity')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:Entity','e')
            ->andWhere('e.id=1')
            ->andWhere('a.id=p.artist')
            ->andWhere('ei.entity=1')
            ->andWhere('ei.row=p.id')
            ->andWhere('ei.interaction=3')
            ->andWhere('ei.date > :date')
            ->setParameter(':date', $date)
            ->groupBy('p.id')
            ->orderBy('count(p)','DESC')
            ->setMaxResults(7)
            ->getQuery()
            ->getResult();

        return $q1;
    }

    private function getMostViewStatues():? array
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        return $this->createQueryBuilder('ei')
            ->select('s.id','s.name','a.name as artist', 'a.id as artistID', 'count(s) as viewed','e.name as entity')
            ->from('App:StatueEntity','s')
            ->from('App:ArtistEntity','a')
            ->from('App:Entity','e')
            ->andWhere('e.id=1')
            ->andWhere('a.id=s.artist')
            ->andWhere('ei.entity=6')
            ->andWhere('ei.row=s.id')
            ->andWhere('ei.interaction=3')
            ->andWhere('ei.date > :date')
            ->setParameter(':date', $date)
            ->groupBy('s.id')
            ->orderBy('count(s)','DESC')
            ->setMaxResults(7)
            ->getQuery()
            ->getResult();
    }

    public function getMostViews()
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        if ($this->locale == "en")
        {
            $q1 = $this->getMostViewPaintings();
            $q2 = $this->getMostViewStatues();

            return array_merge($q1, $q2);
        }
        else
        {
            $q1 = $this->getMostViewPaintings();

            $languageResultMostViewPaintings = $this->createQueryBuilder('ei')
                ->select('p.id','paintingTranslation.name','p.thumbImage as image','p.width',
                    'p.height','paintingTranslation.colorsType','paintingTranslation.artist as artist', 'a.id as artistID', 'count(p) as viewed','e.name as entity')
                ->from('App:PaintingEntity','p')
                ->from('App:ArtistEntity','a')
                ->from('App:Entity','e')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('e.id=1')
                ->andWhere('a.id=p.artist')
                ->andWhere('ei.entity=1')
                ->andWhere('ei.row=p.id')
                ->andWhere('ei.interaction=3')
                ->andWhere('ei.date > :date')
                ->setParameter(':date', $date)
                ->groupBy('p.id')
                ->orderBy('count(p)','DESC')
                ->setMaxResults(7)
                ->getQuery()
                ->getResult();

            $finalQ1 = $this->finalTranslationResult($languageResultMostViewPaintings, $q1);
            $q2 = $this->getMostViewStatues();

            return array_merge($finalQ1, $q2);
        }
    }

    public function getClientFollows($client):array
    {
        return $this->createQueryBuilder('ei')
            ->select('a.id as artist')
            ->from('App:ArtistEntity','a')
            ->andWhere('ei.entity=2')
            ->andWhere('ei.row=a.id')
            ->andWhere('ei.client=:client')
            ->andWhere('ei.interaction=2')
            ->setParameter('client',$client)
            ->groupBy('ei.id')
            ->getQuery()
            ->getResult();
    }

    private function finalTranslationResult($languageResult, $result):?array
    {
        foreach ($languageResult as $singleLanguageResult)
        {
            foreach ($result as $index => $singleResult)
            {
                if ($singleResult['id'] == $singleLanguageResult['id'])
                {
                    unset($result[$index]);
                }
            }
        }

        foreach ($languageResult as $singleLanguageResult)
        {
            $result[] = $singleLanguageResult;
        }

        return $result;
    }
}
