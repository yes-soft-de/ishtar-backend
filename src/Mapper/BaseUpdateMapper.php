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
use App\Entity\StatueEntity;
use App\Entity\StoryEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class BaseUpdateMapper implements BaseUpdateMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity) {
            case "Artist":
                $artistMapper = new ArtistMapper();
                return $artistMapper->artistData($data,
                    $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]));
                break;

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                return $artTypeMapper->artTypeData($data,
                    $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]));
                break;

            case "Painting":
                $paintingMapper = new PaintingMapper();
                 return $paintingMapper->PaintingData($data,
                     $this->entityManager->getRepository(PaintingEntity::class)->find($data["id"]),$this->entityManager);
                break;

            case "Client":
                $clientMapper = new ClientMapper();
                return $clientMapper->clientData($data,
                    $this->entityManager->getRepository(ClientEntity::class)->findOneById($data["id"]));
                break;

            case "Interaction":
                $interactionMapper = new InteractionMapper();
                return $interactionMapper->interactionData($data,
                    $this->entityManager->getRepository(InteractionEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Auction":
                $auctionMapper = new AuctionMapper();
                return $auctionMapper->auctionData($data,
                    $this->entityManager->getRepository(AuctionEntity::class)->findOneById($data["id"]));
                break;

            case "AuctionPainting":
                $auctionPaintingMapper = new AuctionPaintingMapper();
                return $auctionPaintingMapper->auctionPaintingData($data,
                    $this->entityManager->getRepository(AuctionPaintingEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "ArtistArtType":
                $artistArtTypeMapper = new ArtistArtTypeMapper();
                return $artistArtTypeMapper->artistArttypeData($data,
                    $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "PaintingTransaction":
                $paintingTransactionMapper = new PaintingTransactionMapper();
                return $paintingTransactionMapper->paintingTransactionData($data,
                    $this->entityManager->getRepository(PaintingTransactionEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Clap":
                $clapMapper = new ClapMapper();
                return $clapMapper->ClapData($data,
                    $this->entityManager->getRepository(ClapEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Comment":
                $commentMapper = new CommentMapper();
                return $commentMapper->CommentData($data,
                    $this->entityManager->getRepository(CommentEntity::class)->find($data["id"]),
                    $this->entityManager);
                break;

            case "PaintingArtType":
                $mapper = new EntityArtTypeMapper();
                return $mapper->EntityArtTypeData($data,
                    $this->entityManager->getRepository(EntityArtTypeEntity::class)->find($data["id"]),
                    $this->entityManager);
                break;

            case "Story":
                $mapper = new StoryMapper();
                return $mapper->StoryData($data,
                    $this->entityManager->getRepository(StoryEntity::class)->findByPainting($data['id']),
                    $this->entityManager);
                break;

            case "Price":
                $mapper = new PriceMapper();
                return $mapper->PriceData($data,
                    $this->entityManager->getRepository(PriceEntity::class)->find($data["id"]),
                    $this->entityManager);
                break;
            case "Statue":
                $mapper = new StatueMapper();
                return $mapper->statueData($data,
                    $this->entityManager->getRepository(StatueEntity::class)->find($data["id"]),
                    $this->entityManager);
                break;

        }
    }


}
