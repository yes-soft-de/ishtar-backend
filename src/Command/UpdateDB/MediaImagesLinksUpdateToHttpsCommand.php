<?php

namespace App\Command\UpdateDB;

use App\Request\UpdateMediaImageLinkRequest;
use App\Response\GetAllMediaResponse;
use App\Service\EntityMediaService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MediaImagesLinksUpdateToHttpsCommand extends Command
{
    protected static $defaultName = 'MediaImagesLinksUpdateToHttps';

    private $mediaService;

    public function __construct(EntityMediaService $mediaService)
    {
        $this->mediaService = $mediaService;
        parent::__construct();
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

            //update url
            $resolvedPath = str_replace("http:", "Https:", $imagePath);

            //save new image path to DB
            $request = new UpdateMediaImageLinkRequest();
            $request->setId($imageId);
            $request->setImage($resolvedPath);

            $this->mediaService->updateMediaImageLink($request);

            //show progress
            $io->progressAdvance();
        }

        $io->success('Success.');

        return 0;
    }
}
