<?php

namespace App\Repository;

use App\Entity\EntityArtTypeEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\PaintingEntity;
use App\Entity\PaintingTranslationEntity;
use App\EventListener\LocaleListener;
use App\Response\GetPaintingsResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method PaintingEntity[]    findAll()
 * @method PaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingEntityRepository extends ServiceEntityRepository
{
    private $locale;

    public function __construct(ManagerRegistry $registry, LocaleListener $localeListener)
    {
        parent::__construct($registry, PaintingEntity::class);

        if (null == $localeListener->getLocale())
        {
            $this->locale = "en";
        }
        else
        {
            $this->locale = $localeListener->getLocale();
        }
    }


    private function findOnePaintingById($value): ?array
    {
        $result = $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.keyWords','p.state','p.height','p.width','p.colorsType','p.image'
                ,'p.active','a.name as artist', 'a.id as artistID', 'st.story','pr.price')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:StoryEntity','st')
            ->from('App:PriceEntity', 'pr')
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=st.row')
            ->andWhere('p.id = :val')
            ->andWhere('st.entity=1')
            ->groupBy('p.id')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
        $result=array_merge($result,$this->getEntityManager()->getRepository
        (EntityArtTypeEntity::class)->getPaintingArtTypes($value));
        $result=array_merge($result,$this->getEntityManager()->getRepository(EntityMediaEntity::class)->findPaintingImage($value));
        return $result;
    }

    public function findOneById($value): ?array
    {
        if ($this->locale == "en")
        {
            $result = $this->findOnePaintingById($value);
            return $result;
        }
        else
        {
            $result = $this->findOnePaintingById($value);

            $languageResult = $this->createQueryBuilder('q')
                ->select('p.id','paintingTranslation.name','paintingTranslation.keyWords','p.state','p.height','p.width',
                    'paintingTranslation.colorsType','p.image'
                    ,'p.active','paintingTranslation.artist as artist', 'a.id as artistID', 'paintingTranslation.story','pr.price')
                ->from('App:PaintingEntity','p')
                ->from('App:ArtistEntity','a')
                ->from('App:StoryEntity','st')
                ->from('App:PriceEntity', 'pr')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('p.id=pr.row')
                ->andWhere('pr.entity=1')
                ->andWhere('p.artist=a.id')
                ->andWhere('p.id=st.row')
                ->andWhere('p.id = :val')
                ->andWhere('st.entity=1')
                ->groupBy('p.id')
                ->setParameter('val', $value)
                ->getQuery()
                ->getArrayResult();

            if (empty($languageResult))
            {
                return $result;
            }
            else
            {
                $languageResult = array_merge($languageResult, $this->getEntityManager()->getRepository
                (PaintingTranslationEntity::class)->getPaintingArtTypes($value, $this->locale));
                $languageResult = array_merge($languageResult, $this->getEntityManager()->getRepository
                (EntityMediaEntity::class)->findPaintingImage($value));

                return $languageResult;
            }
        }
       // dd($languageResult);
    }

    private  function  getAllPaintings():?array
    {
        return $this->createQueryBuilder('p')

            ->select('p.id', 'p.name','p.state','p.height','p.width','p.colorsType', 'p.image as originalImage', 'p.thumbImage as image','p.active',
                'p.keyWords', 'a.name as artist','at.name as artType','st.story','pr.price')

            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
            ->from('App:StoryEntity','st')
            ->from('App:PriceEntity','pr')

            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=1')
            ->andWhere('p.id=st.row')
            ->andWhere('st.entity=1')
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

    public function getAll():?array
    {
        if ($this->locale == "en")
        {
            $result = $this->getAllPaintings();
            return $result;
        }
        else
        {
            $result = $this->getAllPaintings();

            $languageResult = $this->createQueryBuilder('p')

                ->select('p.id', 'paintingTranslation.name','p.state','p.height','p.width','paintingTranslation.colorsType',
                    'p.image as originalImage', 'p.thumbImage as image','p.active',
                    'paintingTranslation.keyWords', 'paintingTranslation.artist as artist', 'paintingTranslation.artType as artType',
                    'paintingTranslation.story','pr.price')

                ->from('App:ArtistEntity','a')
                ->from('App:ArtTypeEntity','at')
                ->from('App:EntityArtTypeEntity','eat')
                ->from('App:StoryEntity','st')
                ->from('App:PriceEntity','pr')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('p.artist=a.id')
                ->andWhere('p.id=eat.row')
                ->andWhere('at.id=eat.artType')
                ->andWhere('eat.entity=1')
                ->andWhere('p.id=st.row')
                ->andWhere('st.entity=1')
                ->andWhere('p.id=pr.row')
                ->andWhere('pr.entity=1')
                ->groupBy('p.id')
                ->getQuery()
                ->getResult();

            return $this->finalTranslationResult($languageResult, $result);
        }
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

    private function getPaintingBy($parm,$value)
    {
        if($parm == 'artType')
        {
            $parm = 'eat.artType='.$value;
        }
        else
        {
            $parm = "p." . $parm . "='" . $value . "'";
        }

        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.name', 'p.keyWords', 'p.state', 'p.height', 'p.width', 'p.colorsType', 'p.image',
                'p.active', 'a.name as artist', 'at.name as artType','pr.price','st.story ')
            ->from('App:ArtistEntity', 'a')
            ->from('App:ArtTypeEntity', 'at')
            ->from('App:EntityArtTypeEntity', 'eat')
            ->from('App:PriceEntity', 'pr')
            ->from('App:StoryEntity','st')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=1')
            ->andWhere($parm)
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->andWhere('p.active=1')
            ->andWhere('st.entity=1')
            ->andWhere('st.row=p.id')
            ->orderBy('p.id', 'ASC')
            ->groupBy('p.name')
            ->getQuery()
            ->getResult();
    }

    public function getBy($parm,$value):?array
    {
        if ($this->locale == "en")
        {
            $result = $this->getPaintingBy($parm,$value);
            return $result;
        }
        else
        {
            $result = $this->getPaintingBy($parm,$value);

            if($parm == 'artType')
            {
                $parm = 'eat.artType='.$value;
            }
            else
            {
                $parm = "p." . $parm . "='" . $value . "'";
            }
            $languageResult = $this->createQueryBuilder('p')
                ->select('p.id', 'paintingTranslation.name', 'paintingTranslation.keyWords', 'p.state', 'p.height', 'p.width',
                    'paintingTranslation.colorsType', 'p.image',
                    'p.active', 'paintingTranslation.artist as artist', 'paintingTranslation.artType as artType','pr.price','paintingTranslation.story ')
                ->from('App:ArtistEntity', 'a')
                ->from('App:ArtTypeEntity', 'at')
                ->from('App:EntityArtTypeEntity', 'eat')
                ->from('App:PriceEntity', 'pr')
                ->from('App:StoryEntity','st')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('p.artist=a.id')
                ->andWhere('p.id=eat.row')
                ->andWhere('at.id=eat.artType')
                ->andWhere('eat.entity=1')
                ->andWhere($parm)
                ->andWhere('p.id=pr.row')
                ->andWhere('pr.entity=1')
                ->andWhere('p.active=1')
                ->andWhere('st.entity=1')
                ->andWhere('st.row=p.id')
                ->orderBy('p.id', 'ASC')
                ->groupBy('p.name')
                ->getQuery()
                ->getResult();

            return $this->finalTranslationResult($languageResult, $result);
        }
    }

    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->select('a.id','a.name','count(p) as painting','at.name as artType','m.path as image')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
           ->distinct('p.id')
            ->Where('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('at.id=eat.artType')
            ->andWhere('p.artist=a.id')
            ->andWhere('eat.entity=2')
            ->andWhere('p.active=1')
            ->andWhere('a.id=ea.row')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * @method getPainting
     * @param $id
     * @return PaintingEntity
     *
     */
    public function getPainting($id):PaintingEntity
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.id=:id')
                ->groupBy('p.id')
                ->getQuery()
                ->setParameter('id',$id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    private function getAllFeatured():?array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id','p.name','p.state','p.height','p.width','p.colorsType','p.thumbImage as image','p.active',
                'p.keyWords', 'a.name as artist','at.name as artType','st.story','pr.price')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
            ->from('App:StoryEntity','st')
            ->from('App:PriceEntity','pr')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=1')
            ->andWhere('p.id=st.row')
            ->andWhere('st.entity=1')
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->andWhere('p.isFeatured = 1')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

    public function getAllFeaturedPaintings():?array
    {
        if ($this->locale == "en")
        {
            $result = $this->getAllFeatured();
            return $result;
        }
        else
        {
            $result = $this->getAllFeatured();

            $languageResult = $this->createQueryBuilder('p')
                ->select('p.id','paintingTranslation.name','p.state','p.height','p.width','paintingTranslation.colorsType',
                    'p.thumbImage as image','p.active',
                    'paintingTranslation.keyWords', 'paintingTranslation.artist as artist','paintingTranslation.artType as artType','paintingTranslation.story','pr.price')
                ->from('App:ArtistEntity','a')
                ->from('App:ArtTypeEntity','at')
                ->from('App:EntityArtTypeEntity','eat')
                ->from('App:StoryEntity','st')
                ->from('App:PriceEntity','pr')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('p.artist=a.id')
                ->andWhere('p.id=eat.row')
                ->andWhere('at.id=eat.artType')
                ->andWhere('eat.entity=1')
                ->andWhere('p.id=st.row')
                ->andWhere('st.entity=1')
                ->andWhere('p.id=pr.row')
                ->andWhere('pr.entity=1')
                ->andWhere('p.isFeatured = 1')
                ->groupBy('p.id')
                ->getQuery()
                ->getResult();
        }

        return $this->finalTranslationResult($languageResult, $result);
    }
}
