<?php


namespace App\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class KafkaSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        //echo "KAFKA IS READY";
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        //echo "KAFKA IS READY";
    }
}