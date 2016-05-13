<?php

namespace Nuada\ApiBundle\Command;

use Nuada\ApiBundle\Entity\ListingDetail;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class PopulateListingSummaryCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nuada-api:populate-listing-summary')
            ->setDescription('Populate nl_listing_detail table');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->legacyConnection = $this->getContainer()->get('doctrine.dbal.default_connection');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $conn = $this->getContainer()->get('doctrine')->getConnection();
        try{
            $conn->beginTransaction();
            $count = array();
            $data = $this->fetchListingTypes();
            if (!$data) {
                $output->writeln('No listing found!');
                return;
            }
            $this->hidePreviousDetails();

            foreach ($data as $datum) {
                $listingType = $datum['listingTypes'];
                $count = $this->fetchCountForListingType($listingType);
                $summary = $this->addSummary($listingType, $count);
            }

            $conn->commit();
        } catch(Exception $e) {
            $conn->beginTransaction();
            throw $e;
        }

        
    }

     private function hidePreviousDetails() {
         $qb = $this->legacyConnection->createQueryBuilder()
            ->update('nl_listing_detail', 'l')
            ->set('l.deleted', 1)
            ->where('l.deleted = 0');

        $result = $qb->execute();

        return $result;
    }

    private function fetchListingTypes() {
         $qb = $this->legacyConnection->createQueryBuilder()
            ->select('distinct listing_type as listingTypes')
            ->from('bf_listing', 'l')
            ->where('l.deleted = 0');

        $result = $qb->execute();

        return $result->fetchAll();
    }

    private function fetchCountForListingType($listingType) {
         $qb = $this->legacyConnection->createQueryBuilder()
            ->select('count(*) as count')
            ->from('bf_listing', 'l')
            ->where('l.listing_type = :listingType')
            ->AndWhere('l.deleted = 0')
            ->setParameter('listingType', $listingType);

        $result = $qb->execute();
        
        return $result->fetch()['count'];
    }

    private function addSummary($type, $count)
    {
        $detail = new ListingDetail();
        $detail->setListingType($type);
        $detail->setCount($count);
        $detail->setCreatedAt(new \DateTime());
        $detail->setDeleted(false);
        
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($detail);
        $em->flush();
    }
}