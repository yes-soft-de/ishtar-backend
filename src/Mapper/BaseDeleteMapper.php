<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\ClientEntity;
use App\Entity\EntityInteractionEntity;
use App\Entity\PaintingEntity;
use App\Entity\InteractionEntity;
use App\Entity\AuctionEntity;
use App\Entity\AuctionPaintingEntity;
use App\Entity\ArtistArtTypeEntity;
use App\Entity\PaintingTransactionEntity;
use App\Entity\ImageEntity;
use App\Entity\PriceEntity;
use App\Entity\VideoEntity;
use App\Entity\ClapEntity;
use App\Entity\CommentEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArtistEntityRepository;


class BaseDeleteMapper implements BaseDeleteMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function deleteMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity) {
            case "Artist":
                return $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]);
                break;

            case "ArtType":
                return $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]);
                break;

            case "Painting":
                return $this->entityManager->getRepository(PaintingEntity::class)->find($data["id"]);
                break;

            case "Client":
                return $this->entityManager->getRepository(ClientEntity::class)->findOneById($data["id"]);
                break;

            case "Interaction":
                return $this->entityManager->getRepository(EntityInteractionEntity::class)->find($data["id"]);
                break;

            case "Auction":
                return $this->entityManager->getRepository(AuctionEntity::class)->findOneById($data["id"]);
                break;

            case "AuctionPainting":
                return $this->entityManager->getRepository(AuctionPaintingEntity::class)->findOneById($data["id"]);
                break;

            case "ArtistArtType":
                return $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findOneById($data["id"]);
                break;

            case "PaintingTransaction":
                return $this->entityManager->getRepository(PaintingTransactionEntity::class)->findOneById($data["id"]);
                break;


            case "Clap":
                return $this->entityManager->getRepository(ClapEntity::class)->findOneById($data["id"]);
                break;

            case "Comment":
                return $this->entityManager->getRepository(CommentEntity::class)->find($data["id"]);
                break;

            case "Price":
                return $this->entityManager->getRepository(PriceEntity::class)->find($data["id"]);
                break;
        }
    }
}