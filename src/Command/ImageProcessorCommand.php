<?php

namespace App\Command;

use App\AutoMapping;
use App\Request\UpdatePaintingThumbImageRequest;
use App\Response\GetPaintingsResponse;
use App\Service\ImageResolveService;
use App\Service\PaintingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImageProcessorCommand extends Command
{
    protected static $defaultName = 'ImageProcessor';

    private $paintingService;
    private $autoMapping;
    private $imageResolve;

    public function __construct(PaintingService $paintingService, ImageResolveService $imageResolve, AutoMapping $autoMapping)
    {
        parent::__construct();
        $this->paintingService = $paintingService;
        $this->autoMapping = $autoMapping;
        $this->imageResolve = $imageResolve;
    }

    protected function execute( InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $paintings = $this->paintingService->getAll();

        $io->progressStart(count($paintings));

        /**
         * @var $painting GetPaintingsResponse
         */
        foreach ($paintings as $painting)
        {
            //get image path and id
            $imagePath = $painting->getImage();
            $imageId = $painting->getId();

            //resolve image
            $resolvedImage = $this->imageResolve->makeThumb($imagePath);

            //save new image path to DB
            $request = new UpdatePaintingThumbImageRequest();

            $request->setId($imageId);
            $request->setThumbImage($resolvedImage);

            $this->paintingService->updatePaintingThumbImage($request);

            //show progress
            $io->progressAdvance();
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
