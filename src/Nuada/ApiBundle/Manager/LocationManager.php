<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;

class LocationManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                Connection $legacyConnection)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->legacyConnection = $legacyConnection;
    }

    public function load($search=null) {
        $allLocations = $this->fetchAllLocations();

        if (is_null($search)) {
            return $allLocations;
        }
        
        $searchResult = array();
        
        foreach ($allLocations as $location) {
            if((substr(strtolower($location), 0, 1) === $search)) {
                $searchResult[] = $location;
            }
        }
        
        return $searchResult;
    }

    public function fetchAllLocations()
    {
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