<?php

namespace App\Command\Email;

use App\Response\ClientReport;
use App\Service\ReportServiceInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class WeeklyClientReportCommand extends Command
{
    protected static $defaultName = 'weekly-client-report';
    private $mailer;
    private $reportService;
    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(ReportServiceInterface $reportService, MailerInterface $mailer, ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->reportService = $reportService;

        parent::__construct();
        $this->params = $params;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $paintingLink = $this->params->get('CURRENT_SITE_MAILER');
        $data = $this->reportService->sendReportsToClients();
        $mostViews = $this->reportService->getMostViews();
        /**
         * @var $singleData ClientReport
         */
        foreach ($data as $singleData)
        {
            $sendTo = $singleData->getEmail();
            $clientName = $singleData->getUsername();
            $details = $singleData->getEmailData();

            if ($singleData->getEmailData() != null)
            {
                $email = (new TemplatedEmail())
                    ->from(Address::fromString('Ishtar <info@ishtar-art.de>'))
                    ->to("Kenanhussein1@gmail.com")
                    ->subject('Ishtar weekly report')
                    ->htmlTemplate('Emails/ClientEmail.html.twig')
                    ->context(
                        ['clientName' => $clientName,
                            'details' => $details,
                            'imageLink' => $paintingLink,
                            'mostViews' => $mostViews
                        ]);

                $this->mailer->send($email);
            }
        }

        return 1;
    }
}
