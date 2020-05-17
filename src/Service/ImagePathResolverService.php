<?php


namespace App\Service;

use Liip\ImagineBundle\Imagine\Cache\Resolver\WebPathResolver;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\RequestContext;

class ImagePathResolverService extends WebPathResolver
{
    const DEVPATH = '/home/u956437553/domains/dev-ishtar.96.lt/public_html/ImageUploads/';
    const OFFLINEPATH = '/YesSoft/ImageUploads/';
    const PRODPATH = '/home/u176676555/domains/ishtar-art.de/public_html/ImageUploads/';

    public function __construct(Filesystem $filesystem, RequestContext $requestContext, string $webRootDir='', string $cachePrefix = 'media/cache')
    {

        $webRootDir = self::PRODPATH; //'/Tests.PHP/';
        $cachePrefix =  'ResolvedImages'; //$this->cachePrefix;

        parent::__construct($filesystem, $requestContext, $webRootDir, $cachePrefix);

    }
}