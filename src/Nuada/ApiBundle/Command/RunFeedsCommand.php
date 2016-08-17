<?php

namespace Nuada\ApiBundle\Command;

use Nuada\ApiBundle\Entity\Summary;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class RunFeedsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nuada-api:run-feeds')
            ->setDescription('Run Feeds for all companies');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->legacyConnection = $this->getContainer()->get('doctrine.dbal.default_connection');
        $this->feedsUrl = $this->getContainer()->getParameter('feeds_url');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $totalCompanies = $this->fetchTotalCompanies();

        if ($totalCompanies) {
            echo '=============Starting sync for '. $totalCompanies. ' companies ================';
            for ($i=0; $i < $totalCompanies; $i++) {
                try {
                    $ch = curl_init(); 
                    curl_setopt($ch, CURLOPT_URL, $this->feedsUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    $result = curl_exec($ch);
                    
                    if (!$result || $result == '' || empty($result)) {
                        $result = 'FAILED';
                    }

                    echo '   '. $result;
                    curl_close($ch);
                } catch(Exception $e) {
                    var_dump($e);die;
                }
                echo '============================Sync Completed=====================================';
            }
        }
    }

    private function fetchTotalCompanies()
    {
        $qb = $this->legacyConnection->createQueryBuilder()
            ->select('count(*) as total')
            ->from('bf_company', 'c')
            ->where('c.enable = 1');

        $result = $qb->execute();

        return $result->fetch()['total'];
    }

    
}