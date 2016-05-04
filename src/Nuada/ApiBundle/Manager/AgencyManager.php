<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\Agency;

class AgencyManager
{
    protected $doctrine;
    protected $securityContext;
    protected $photoManager;
    protected $legacyConnection;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                PhotoManager $photoManager,
                                AgentManager $agentManager,
                                Connection $legacyConnection)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->photoManager = $photoManager;
        $this->agentManager = $agentManager;
        $this->legacyConnection = $legacyConnection;
    }

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $name = null,
            $userId = null,
            $userName = null,
            $sortOn = null,
            $reverse = false,
            $withPhotos=true,
            $withAgents=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $agencies = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $userName,
            $sortOn,
            $reverse);

        
        if (!is_null($agencies)) {
            
            //with photos
            if ($withPhotos) {
                if (is_array($agencies)) {
                    foreach ($agencies as $agency) {
                        $agencyId = $agency->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            null, //$listingId
                            $agencyId
                        );
                        $agency->setPhotos($photos);
                    }
                } else {
                    $agencyId = $agencies->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        null, //$listingId
                        $agencyId
                    );
                    $agencies->setPhotos($photos);

                }
            }

            //with agents
            if ($withAgents) {
                if (is_array($agencies)) {
                    foreach ($agencies as $agency) {
                        $agencyId = $agency->getId();
                        $agents = $this->agentManager->load(
                            null, //$id
                            null, //$limit
                            null, //$offset
                            null, //$withDeleted
                            null, //$name
                            null, //$userId
                            $agencyId
                        );
                        $agency->setAgents($agents);
                    }
                } else {
                    $agencyId = $agencies->getId();
                    $agents = $this->agentManager->load(
                            null, //$id
                            null, //$limit
                            null, //$offset
                            null, //$withDeleted
                            null, //$name
                            null, //$userId
                            $agencyId
                    );
                    $agencies->setAgents($agents);

                }
            }
        }

        return $agencies;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $name = null,
                         $userId = null,
                         $userName = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $userName);

        return intval($count);

    }

    public function loadForNeighbourhood ($neighbourhood=null, $agencyCount=null)
    {
        if (is_null($neighbourhood) || is_null($agencyCount)) {
            throw new BadAttributeException('neighbourhood or count cant be null in request');
        }

        if (strcasecmp($neighbourhood, 'Dubai') == 0) {
            $query = $this->legacyConnection->executeQuery('
                SELECT a.*  from bf_company a 
                LEFT JOIN nl_agency_neighbourhood an
                ON an.agency_id = a.id
                LEFT JOIN nl_neighbourhood n
                ON an.neighbourhood_id = n.id
                order by a.score DESC',
                array("$neighbourhood"));
        } else {
            $query = $this->legacyConnection->executeQuery('
                SELECT a.*  from bf_company a 
                LEFT JOIN nl_agency_neighbourhood an
                ON an.agency_id = a.id
                LEFT JOIN nl_neighbourhood n
                ON an.neighbourhood_id = n.id
                where n.name = ?
                order by a.score DESC',
                array("$neighbourhood"));
        }



        $data = $query->fetchAll();
        $agencies = array_slice($data, 0, $agencyCount);

        $hydratedAgencies = $this->hydrate($agencies);

        return $hydratedAgencies;
    }

    public function hydrate($agencies) {
        $hydratedAgencies = array();

        if ($agencies == null) {
            return null;
        }

        foreach($agencies as $agency) {
            $hydratedAgency = new Agency();
            $hydratedAgency->setId($agency['id']);
            $hydratedAgency->setName($agency['name']);
            $hydratedAgency->setUserId($agency['user_id']);
            $hydratedAgency->setUserName($agency['user_name']);
            $hydratedAgency->setEmail($agency['email']);
            $hydratedAgency->setAddress($agency['address']);
            $hydratedAgency->setDescription($agency['description']);
            $hydratedAgency->setScore($agency['score']);

            $hydratedAgencies[] = $hydratedAgency;

        }

        return $hydratedAgencies;
    }

    public function fetchPhoneNumber($agencyId=null) {
        if (is_null($agencyId)) {
            return null;
        }

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $agency = $er->retrieveAll($agencyId);

        $phoneNumber = $agency->getPhone();

        return $phoneNumber;
    }

}