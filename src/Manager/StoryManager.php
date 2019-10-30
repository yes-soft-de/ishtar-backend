<?php


namespace App\Manager;

use App\Entity\StoryEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\StoryMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StoryManager
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request,$entity)
    {
        $story= json_decode($request->getContent(),true);
        $storyEntity=new StoryEntity();
        $storyMapper = new StoryMapper();
        $storyData=$storyMapper->StoryData($story, $storyEntity,$this->entityManager);
        $this->entityManager->persist($storyData);
        $this->entityManager->flush();
        return $storyEntity;
    }

        public function update(Request $request,$entity)
    {
        $story = json_decode($request->getContent(),true);
        $storyEntity=$this->entityManager->getRepository(StoryEntity::class)
            ->findEntity($request->get('id'),$entity);
        if (!$storyEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("story");
        }
        else {

            $storyEntity->setStory($story['story']);
            $this->entityManager->flush();
            return $storyEntity;
        }
    }

//    public function getAll()
//    {
//        $storysLists[]=new StorysListResponse();
//        $data=$this->entityManager->getRepository(StoryEntity::class)->findAll();
//        $i=0;
//        foreach ($storysLists as &$list) {
//            $list = $this->autoMapper->map((object)$data[$i],$list);
//            $i++;
//        }
//        return $storysLists;
//    }

}
