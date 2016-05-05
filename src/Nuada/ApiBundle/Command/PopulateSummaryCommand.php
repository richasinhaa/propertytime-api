<?php

namespace Nuada\ApiBundle\Command;

use Nuada\ApiBundle\Entity\Summary;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class PopulateSummaryCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nuada-api:populate-summary')
            ->setDescription('Populate nl_summary table');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->legacyConnection = $this->getContainer()->get('doctrine.dbal.default_connection');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $listings = $this->fetchTotalListings();
        $output->writeln('Total Listings :: '. $listings);
        $users = $this->fetchTotalUsers();
        $output->writeln('Total Users :: '. $users);
        $listingsAddedInLastOneDay = $this->fetchListingsAddedInLastOneDay();
        $output->writeln('Total Listing added in 24 hours :: '. $listingsAddedInLastOneDay);
        $listingsSoldOrRented = $this->fetchListingsSoldOrRented();
        $output->writeln('Total Listing sold or rented :: '. $listingsSoldOrRented);

        $summary = $this->addSummary($listings, $users, $listingsAddedInLastOneDay, $listingsSoldOrRented);
    }

    private function fetchTotalListings() {
        $qb = $this->legacyConnection->createQueryBuilder()
            ->select('count(*) as listings')
            ->from('bf_listing', 'l')
            ->where('l.deleted = 0');

        $result = $qb->execute();

        return $result->fetch()['listings'];
    }

    private function fetchTotalUsers() {
        $qb = $this->legacyConnection->createQueryBuilder()
            ->select('count(*) as users')
            ->from('bf_users', 'u')
            ->where('u.deleted = 0');

        $result = $qb->execute();

        return $result->fetch()['users'];
    }

    private function fetchListingsAddedInLastOneDay() {
        $qb = $this->legacyConnection->createQueryBuilder()
            ->select('count(*) as listing_last_day')
            ->from('bf_listing', 'l')
            ->where('l.deleted = 0')
            ->Andwhere('l.created_on >= now() - INTERVAL 1 DAY');

        $result = $qb->execute();

        return $result->fetch()['listing_last_day'];
    }

    private function fetchListingsSoldOrRented() {
        $legacyConnection = $this->getContainer()->get('doctrine.dbal.default_connection');
        $qb = $legacyConnection->createQueryBuilder()
            ->select('count(*) as listing_sold_or_rented')
            ->from('bf_listing', 'l')
            ->where('l.deleted = 0')
            ->Andwhere('l.is_sold = 1');

        $result = $qb->execute();

        return $result->fetch()['listing_sold_or_rented'];
    }

    private function addSummary($listings, $users, $listingsAddedInLastOneDay, $listingsSoldOrRented) {
        $summary = new Summary();
        $summary->setProperties($listings);
        $summary->setUsers($users);
        $summary->setPropertiesAddedInLast24Hours($listingsAddedInLastOneDay);
        $summary->setPropertiesSoldOrRented($listingsSoldOrRented);
        $summary->setCreatedAt(new \DateTime());

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($summary);
        $em->flush();
    }
}