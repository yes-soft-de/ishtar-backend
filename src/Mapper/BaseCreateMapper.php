<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\ClientEntity;
use App\Entity\EntityArtTypeEntity;
use App\Entity\PaintingEntity;
use App\Entity\InteractionEntity;
use App\Entity\AuctionEntity;
use App\Entity\AuctionPaintingEntity;
use App\Entity\PaintingTransactionEntity;
use App\Entity\ClapEntity;
use App\Entity\CommentEntity;
use App\Entity\PriceEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArtistEntityRepository;

class BaseCreateMapper implements BaseCreateMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(),true);
        switch ($entity)
        {
            case "Artist":
                $artistMapper = new ArtistMapper();
                $artistEntity = new ArtistEntity();
                return $artistMapper->artistData($data, $artistEntity);
                break;

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                $artTypeEntity = new ArtTypeEntity();
                return $artTypeMapper->artTypeData($data, $artTypeEntity);
                break;

            case "Painting":

                $paintingMapper = new PaintingMapper();
                $entityArtTypeMapper=new EntityArtTypeMapper();
                $paintingEntity = new PaintingEntity();
                $entityArtTYpeEntity=new EntityArtTypeEntity();
                $entityArtTypeMapper->EntityArtTypeData($data,$entityArtTYpeEntity,$this->entityManager);
                return $paintingMapper->PaintingData($data, $paintingEntity,$this->entityManager);
                break;

            case "Client":
                $clientMapper = new ClientMapper();
                $clientEntity = new ClientEntity();
                return $clientMapper->clientData($data, $clientEntity);
                break;

            case "Interaction":
                $interactionMapper = new InteractionMapper();
                $interactionEntity = new InteractionEntity();
                return $interactionMapper->interactionData($data,$interactionEntity,$this->entityManager);
                break;

            case "Auction":
                $auctionMapper = new AuctionMapper();
                $auctionEntity = new AuctionEntity();
                return $auctionMapper->auctionData($data, $auctionEntity);
                break;

            case "AuctionPainting":
                $auctionPaintingMapper = new AuctionPaintingMapper();
                $auctionPaintingEntity = new AuctionPaintingEntity();
                return $auctionPaintingMapper->auctionPaintingData($data, $auctionPaintingEntity,$this->entityManager);
                break;

            case "ArtistArtType":
                $artistArtTypeMapper = new ArtistArtTypeMapper();
                $artistArtTypeEntity = new ArtistArtTypeEntity();
                return $artistArtTypeMapper->artistArtTypeData($data, $artistArtTypeEntity,$this->entityManager);
                break;

            case "PaintingTransaction":
                $paintingTransactionMapper = new PaintingTransactionMapper();
                $paintingTransactionEntity = new PaintingTransactionEntity();
                return $paintingTransactionMapper->paintingTransactionData($data,$paintingTransactionEntity,$this->entityManager);
                break;


            case "Clap":
                $clapMapper = new ClapMapper();
                $clapEntity = new ClapEntity();
                return $clapMapper->clapData($data, $clapEntity,$this->entityManager);
                break;

            case "Comment":
                $commentMapper = new CommentMapper();
                $commentEntity = new CommentEntity();
                return $commentMapper->CommentData($data, $commentEntity,$this->entityManager);
                break;

            case "EntityArtType":
                $mapper=new EntityArtTypeMapper();
                $entity=new EntityArtTypeEntity();
                return $mapper->EntityArtTypeData($data,$entity,$this->entityManager);

            case "Price":
                $mapper=new PriceMapper();
                $entity=new PriceEntity();
                return $mapper->PriceData($data,$entity,$this->entityManager);
        }
    }
}