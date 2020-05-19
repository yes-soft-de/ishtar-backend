<?php

namespace App\Command\Email;

use App\Response\ArtistReport;
use App\Service\ReportServiceInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class WeeklyArtistReportCommand extends Command
{
    protected static $defaultName = 'weekly-artist-report';
    private $mailer;
    private $reportService;

    public function __construct(ReportServiceInterface $reportService, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->reportService = $reportService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('ask')
            ->setDescription('Interactively asks name from the user')
            ->setHelp('This command asks a user name interactively and prints it');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->reportService->sendReportsToArtists();
        /**
         * @var $singleData ArtistReport
         */
        foreach ($data as $singleData)
        {
            $sendTo = $singleData->getEmail();
            $artistName = $singleData->getName();
            $artistFollowers = $singleData->getFollowers();
            $details = $singleData->getEmailData();

            $email = (new TemplatedEmail())
                ->from(Address::fromString('Ishtar <info@ishtar-art.de>'))
                ->to($sendTo)
                ->subject('Ishtar weekly report')
                ->htmlTemplate('Emails/ArtistEmail.html.twig')
                ->context(
                    ['artistName' => $artistName,
                        'details' => $details,
                        'artistFollowers' => $artistFollowers
                    ]);

            $this->mailer->send($email);
        }

        return 1;
    }


}
