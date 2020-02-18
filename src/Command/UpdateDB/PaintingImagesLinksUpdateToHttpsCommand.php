<?php

namespace App\Command\UpdateDB;

use App\Request\UpdatePaintingImageLinkRequest;
use App\Response\GetPaintingsResponse;
use App\Service\PaintingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PaintingImagesLinksUpdateToHttpsCommand extends Command
{
    protected static $defaultName = 'PaintingImagesLinksUpdateToHttps';
    private $paintingService;

    public function __construct(PaintingService $paintingService)
    {
        parent::__construct();
        $this->paintingService = $paintingService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
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
            $imagePath = $painting->getOriginalImage();
            $imageId = $painting->getId();

            //update url
            $resolvedPath = str_replace("http:", "Https:", $imagePath);

            //save new image path to DB
            $request = new UpdatePaintingImageLinkRequest();
            $request->setId($imageId);
            $request->setImage($resolvedPath);

            $this->paintingService->updatePaintingImageLink($request);

            //show progress
            $io->progressAdvance();
        }

        $io->success('Success!');

        return 0;
    }
}
