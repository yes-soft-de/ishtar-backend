<?php

namespace App\Command\ImageResolve;

use App\Request\UpdateMediaThumbImageRequest;
use App\Response\GetAllMediaResponse;
use App\Service\EntityMediaService;
use App\Service\ImageResolveService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MediaImagesProcessorCommand extends Command
{
    protected static $defaultName = 'MediaImagesProcessor';

    private $mediaService;
    private $imageResolve;

    public function __construct(EntityMediaService $mediaService, ImageResolveService $imageResolve)
    {
        parent::__construct();
        $this->mediaService = $mediaService;
        $this->imageResolve = $imageResolve;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $media = $this->mediaService->getAll();

        $io->progressStart(count($media));

        /**
         * @var $singleMedia GetAllMediaResponse
         */
        foreach ($media as $singleMedia)
        {
            //get image path and id
            $imagePath = $singleMedia->getPath();
            $imageId = $singleMedia->getId();

            //resolve image
            $resolvedImage = $this->imageResolve->makeThumb($imagePath);

            //save new image path to DB
            $request = new UpdateMediaThumbImageRequest();

            $request->setId($imageId);
            $request->setThumbImage($resolvedImage);

            $this->mediaService->updateMediaThumbImageById($request);

            //show progress
            $io->progressAdvance();
        }

        $io->success('Success');

        return 0;
    }
}
