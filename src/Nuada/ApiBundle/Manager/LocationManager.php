<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LocationManager
{
    protected $doctrine;
    protected $securityContext;
    protected $container;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                Connection $legacyConnection,
                                ContainerInterface $container)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->legacyConnection = $legacyConnection;
        $this->container = $container;
    }

    public function load($search=null) {
        $allLocations = $this->fetchAllLocations();

        if (is_null($search)) {
            return $allLocations;
        }

        $searchResult = array();
        $search = strtolower($search);
        
        foreach ($allLocations['Commercial'] as $commercialDetail) {
            if(strpos(strtolower($commercialDetail), $search) !== false) {
                $searchResult['Commercial'][] = $commercialDetail;
            }
        }

        if (array_key_exists('Commercial', $searchResult) && !is_null($searchResult['Commercial'])) {
            $searchResult['Commercial'] = $this->rank($searchResult['Commercial'], $search);
            $searchResult['Commercial'] = array_slice($searchResult['Commercial'], 0, 3);
        }

        foreach ($allLocations['Residential']as $residentialDetail) {
            if(strpos(strtolower($residentialDetail), strtolower($search)) !== false) {
                $searchResult['Residential'][] = $residentialDetail;
            }
        }
        
        if (array_key_exists('Residential', $searchResult) && !is_null($searchResult['Residential'])) {
            $searchResult['Residential'] = $this->rank($searchResult['Residential'], $search);
            $searchResult['Residential'] = array_slice($searchResult['Residential'], 0, 3);
        }

        foreach ($allLocations['Agencies']as $agencyDetail) {
            if(strpos(strtolower($agencyDetail), strtolower($search)) !== false) {
                $searchResult['Agencies'][] = $agencyDetail;
            }
        }

        if (array_key_exists('Agencies', $searchResult) && !is_null($searchResult['Agencies'])) {
            $searchResult['Agencies'] = $this->rank($searchResult['Agencies'], $search);
            $searchResult['Agencies'] = array_slice($searchResult['Agencies'], 0, 3);
        }

        return $searchResult;
    }

    public function fetchAllLocations()
    {
        $fileName = 'locations.cache.php';
        $dirName = 'cache';
        $cache = $this->container->get('kernel')->getRootDir() .'/'.$dirName.'/'. $fileName;
        
        if (file_exists($cache)) {
            $fh = fopen($cache, 'rb');
            $locations = json_decode(fread($fh, filesize($cache)), true);
            fclose($fh);
        } else {
            $query = $this->legacyConnection->executeQuery("
                SELECT derived.location, derived.listing_category from
                      (SELECT DISTINCT city as location, listing_category FROM bf_listing 
                      UNION
                      SELECT DISTINCT community  as location, listing_category from bf_listing
                      UNION
                      SELECT DISTINCT sub_community as location, listing_category from bf_listing
                      UNION
                      select DISTINCT tower as location, listing_category from bf_listing) derived
                WHERE derived.location is not null
                AND derived.listing_category is not null
                ORDER BY derived.listing_category, derived.location"
            );

            $data = $query->fetchAll();

            $agencyQuery = $this->legacyConnection->executeQuery(
                "SELECT DISTINCT name as agency from bf_company
                where name != '0'
                and name is not null
                and name != ''
                and enable = 1
                and deleted = 0
                and publish = 1
                order by name"
            );

            $agency = $agencyQuery->fetchAll();

            $locations = $this->hydrate($data, $agency);
            
            $fh = fopen($cache, 'w+') or die ('error writing location cache file');
            fwrite($fh, json_encode($locations));
            fclose($fh);

        }

        return $locations;
    }

    public function hydrate($data, $agency) {
        $location = array();
        
        $commercial = array();
        $residential = array();
        $agencies = array();

        foreach ($data as $detail) {
            if ($detail['listing_category'] == 'Commercial') {
                $commercial[] = $detail['location'];
            }
            if ($detail['listing_category'] == 'Residential') {
                $residential[] = $detail['location'];
            }
        }

        foreach ($agency as $a) {
            $agencies[] = $a['agency'];
        }

        $location = array('Commercial' => $commercial, 'Residential' => $residential, 'Agencies' => $agencies);
        
        return $location;
    }


    public function rank($locationArray, $search) {
        $rank = null;
        foreach ($locationArray as $location) {
            $position = strpos(strtolower($location), $search);
            $rank[$location][] = $position;
        }
        asort($rank);
        array_multisort(array_values($rank), array_keys($rank), $rank);
        
        return array_keys($rank);
    }

}