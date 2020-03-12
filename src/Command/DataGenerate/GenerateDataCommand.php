<?php

namespace App\Command\DataGenerate;

use App\Request\CreateArtistRequest;
use App\Request\CreateArtTypeRequest;
use App\Request\CreatePaintingRequest;
use App\Service\ArtistServiceInterface;
use App\Service\ArtTypeServiceInterface;
use App\Service\GenerateRandomDataInterface;
use App\Service\PaintingServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateDataCommand extends Command
{
    protected static $defaultName = 'generate-data';
    private $artistService;
    private $generateRandomData;
    private $artTypeService;
    private $paintingService;

    public function __construct(
        ArtistServiceInterface $artistService, ArtTypeServiceInterface $artTypeService,
        PaintingServiceInterface $paintingService, GenerateRandomDataInterface $generateRandomData)
    {
        $this->artistService = $artistService;
        $this->generateRandomData = $generateRandomData;
        $this->artTypeService = $artTypeService;
        $this->paintingService = $paintingService;

        parent::__construct();
    }

    public function artTypeData()
    {
        $data = new CreateArtTypeRequest();

        $data->name = $this->generateRandomData->generateRandomString();
        $data->history = $this->generateRandomData->generateRandomString();
        $data->image = $this->generateRandomData->generateRandomString();

        return$data;

    }

    public function artistData($maxArtType)
    {
        $data =  new CreateArtistRequest();

        $data->name = $this->generateRandomData->generateRandomString();
        $data->nationality = $this->generateRandomData->generateRandomString();
        $data->residence = $this->generateRandomData->generateRandomString();
        $data->birthDate = $this->generateRandomData->generateRandomDate();
        $data->story = $this->generateRandomData->generateRandomString();
        $data->details = $this->generateRandomData->generateRandomString();
        $data->Facebook = $this->generateRandomData->generateRandomString();
        $data->Twitter = $this->generateRandomData->generateRandomString();
        $data->Instagram = $this->generateRandomData->generateRandomString();
        $data->Linkedin = $this->generateRandomData->generateRandomString();
        $data->artType = $this->generateRandomData->generateRandomInt(1, $maxArtType);
        $data->image = $this->generateRandomData->generateRandomString();

        return $data;
    }

    public function paintingData($maxArtist, $maxArtType)
    {
        $data = new CreatePaintingRequest();

        $data->name = $this->generateRandomData->generateRandomString();
        $data->artist = $this->generateRandomData->generateRandomInt(1, $maxArtist);
        $data->height = $this->generateRandomData->generateRandomInt(200, 2000);
        $data->width = $this->generateRandomData->generateRandomInt(200, 2000);
        $data->colorsType = $this->generateRandomData->generateRandomInt(1, 200);
        $data->price = $this->generateRandomData->generateRandomInt(250, 100000);
        $data->state = $this->generateRandomData->generateRandomString();
        $data->image = $this->generateRandomData->generateRandomString();
        $data->active = $this->generateRandomData->generateRandomInt(0,1);
        $data->keyWords = $this->generateRandomData->generateRandomString();
        $data->artType = $this->generateRandomData->generateRandomInt(1, $maxArtType);
        $data->story = $this->generateRandomData->generateRandomString();

        return $data;
    }

    protected function configure()
    {
        $this
            ->setDescription('Marhaba! this to create new artist :3')
           ->addArgument('number', InputArgument::OPTIONAL, 'How many artist want to add?')
           ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //php profiler
        //check from dev before run
        $io = new SymfonyStyle($input, $output);

        $helper = $this->getHelper('question');

        $artTypesQuestion = new Question("Enter number of art types you wish to create: ", "guest");
        $artTypesNumber = $helper->ask($input, $output, $artTypesQuestion);

        $artistsQuestion = new Question("Enter number of artist you wish to create: ", "guest");
        $artistsNumber = $helper->ask($input, $output, $artistsQuestion);

        $paintingsQuestion = new Question("Enter number of paintings you wish to create: ", "guest");
        $paintingsNumber = $helper->ask($input, $output, $paintingsQuestion);

        // art type:
        $io->newLine(2);
        $message = "Creating art types please wait..";
        $output->writeln($message);
        $io->newLine();

        $io->progressStart($artTypesNumber);

        for ($i = 0; $i < $artTypesNumber; $i++)
        {
            $data = $this->artTypeData();

            $this->artTypeService->create($data);

            $io->progressAdvance();
        }

        $io->newLine();
        $message = $artTypesNumber." Art types had been created successfully!";
        $output->writeln($message);
        $io->newLine();

        // artist:
        $message = "Creating artists please wait..";
        $output->writeln($message);
        $io->newLine();

        $io->progressStart($artistsNumber);

        for ($i = 0; $i < $artistsNumber; $i++)
        {
            $data = $this->artistData($artTypesNumber);

            $this->artistService->create($data);

            $io->progressAdvance();
        }

        $io->newLine();

        $message = $artistsNumber." Artist had been created successfully!";
        $output->writeln($message);
        $io->newLine();

        // paintings
        $message = "Creating paintings please wait..";
        $output->writeln($message);
        $io->newLine();

        $io->progressStart($paintingsNumber);

        for ($i = 0; $i < $paintingsNumber; $i++)
        {
            $data = $this->paintingData($artistsNumber, $artTypesNumber);

            $this->paintingService->create($data);

            $io->progressAdvance();
        }

        $io->newLine();

        $message = $artistsNumber." Paintings had been created successfully!";
        $output->writeln($message);
        $io->newLine();

        $io->success('Creation process Done!');

        return 1;
    }
}
