<?php


namespace App\Service;


use Liip\ImagineBundle\Service\FilterService;

class ImageResolveService
{
    private $filterService;
    const MAINFOLDER = 'ImageUploads/';
    const EXPLODEPATHOFFLINE = 'F:/YesSoft/';
    const EXPLODEPATHDEV = 'http://dev-ishtar.96.lt/';
    const EXPLODEPATHPROD = 'Https://ishtar-art.de/';
    const PATHTOREMOVE = 'ishtar-backend/public/';

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function makeThumb($path): string
    {
        $fixedPath = explode(self::EXPLODEPATHPROD, $path);

        $resolvedPath = $this->filterService->getUrlOfFilteredImage($fixedPath[1], 'thumb');

        //for command
        //$result = str_replace('http://localhost/',self::EXPLODEPATHOFFLINE.self::MAINFOLDER, $resolvedPath);

        $result = str_replace(self::PATHTOREMOVE ,self::MAINFOLDER, $resolvedPath);
        return $result;
    }


}