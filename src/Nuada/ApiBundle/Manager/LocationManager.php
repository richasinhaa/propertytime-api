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
        
        foreach ($allLocations as $location) {
            if(strpos(strtolower($location), $search) !== false) {
                $searchResult[] = $location;
            }
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
            $locations = json_decode(fread($fh, filesize($cache)));
            fclose($fh);
        } else {
            $query = $this->legacyConnection->executeQuery("
                SELECT DISTINCT comm
                FROM (
                     SELECT DISTINCT LTRIM(RTRIM(community)) as comm
                            FROM bf_listing
                ) A 
                WHERE comm != ''
                ORDER BY comm asc");

            $data = $query->fetchAll();
            $locations = $this->hydrate($data);
            
            $fh = fopen($cache, 'w+') or die ('error writing location cache file');
            fwrite($fh, json_encode($locations));
            fclose($fh);

        }

        return $locations;
    }

    public function hydrate($data) {
        $locations = array();
        
        foreach ($data as $value) {
            $locations[] = $value['comm'];
        }

        return $locations;
    }

}