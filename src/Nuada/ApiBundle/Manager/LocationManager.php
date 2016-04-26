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
        
        foreach ($allLocations['Commercial'] as $commercialDetail) {
            if(strpos(strtolower($commercialDetail), strtolower($search)) !== false) {
                $searchResult['Commercial'][] = $commercialDetail;
            }
        }

        if (!is_null($searchResult['Commercial'])) {
            $searchResult['Commercial'] = $this->rank($searchResult['Commercial'], $search);
        }

        foreach ($allLocations['Residential']as $residentialDetail) {
            if(strpos(strtolower($residentialDetail), strtolower($search)) !== false) {
                $searchResult['Residential'][] = $residentialDetail;
            }
        }
        
        if (!is_null($searchResult['Residential'])) {
            $searchResult['Residential'] = $this->rank($searchResult['Residential'], $search);
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
                      (SELECT city as location, listing_category FROM bf_listing 
                      UNION
                      SELECT community  as location, listing_category from bf_listing
                      UNION
                      SELECT sub_community as location, listing_category from bf_listing
                      UNION
                      select tower as location, listing_category from bf_listing) derived
                WHERE derived.location is not null
                AND derived.listing_category is not null
                ORDER BY derived.listing_category, derived.location"
            );

            $data = $query->fetchAll();
            $locations = $this->hydrate($data);
            
            $fh = fopen($cache, 'w+') or die ('error writing location cache file');
            fwrite($fh, json_encode($locations));
            fclose($fh);

        }

        return $locations;
    }

    public function hydrate($data) {
        $location = array();
        
        $commercial = array();
        $residential = array();

        foreach ($data as $detail) {
            if ($detail['listing_category'] == 'Commercial') {
                $commercial[] = $detail['location'];
            }
            if ($detail['listing_category'] == 'Residential') {
                $residential[] = $detail['location'];
            }
        }
         $location = array('Commercial' => $commercial, 'Residential' => $residential);
        
        
        return $location;
    }

    public function rank($locationArray, $search) {
        $rank = null;
        foreach ($locationArray as $location) {
            $position = strpos(strtolower($location), $search);
            $rank[$location][] = $position;
        }
        asort($rank);
        
        return array_keys($rank);
    }

}