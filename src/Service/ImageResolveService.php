<?php


namespace App\Service;


use Liip\ImagineBundle\Service\FilterService;

class ImageResolveService
{
    private $filterService;
    const MAINFOLDER = 'ImageUploads/';
    const EXPLODEPATHOFFLINE = 'F:/YesSoft/';
    const EXPLODEPATHDEV = 'http://dev-ishtar.96.lt/';
    const EXPLODEPATHPROD = 'http://ishtar-art.de/';

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function makeThumb($path): string
    {
        $fixedPath = explode(self::EXPLODEPATHOFFLINE, $path);

        $resolvedPath = $this->filterService->getUrlOfFilteredImage($fixedPath[1], 'thumb');

        $result = str_replace('http://localhost/',self::EXPLODEPATHOFFLINE.self::MAINFOLDER, $resolvedPath);
        return $result;
    }


}