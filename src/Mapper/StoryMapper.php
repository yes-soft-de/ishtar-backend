<?php


namespace App\Mapper;


use App\Entity\Entity;
use App\Entity\StoryEntity;
use App\Entity\PaintingEntity;

class StoryMapper
{
    private $en;
    public function StoryData($data, StoryEntity $storyEntity,$entityManger)
    {
        $this->en=$entityManger;
        $entity = $this->en->getRepository(Entity::class)->find(1);
        $story   =$data['story'];
        $row=$this->en->getRepository(PaintingEntity::class)->findBy(array(),array('id'=>'DESC'),1,1);
        $id= $id= $row[0]->getId()+1;


        $storyEntity->setEntity($entity)
            ->setStory($story)
            ->setRow($id);

        return $storyEntity;
    }

}