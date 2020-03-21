<?php


namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleListener implements EventSubscriberInterface
{
    protected $locale;

    public function onKernelRequest(RequestEvent $event)
    {
        //$this->locale = $event->getRequest()->getLocale();
        $this->locale = $event->getRequest()->getPreferredLanguage();
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public static function getSubscribedEvents()
    {
        return [
            // must be registered before (i.e. with a higher priority than) the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}