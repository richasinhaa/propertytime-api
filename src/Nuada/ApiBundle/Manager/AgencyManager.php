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
            $search = null,
            $name = null,
            $userId = null,
            $userName = null,
            $sortOn = null,
            $reverse = false,
            $withPhotos=true,
            $withAgents=false,
            $searchForLocation=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;


        if ($search) {
            //Find agencies with search keyword
            $agencies = $this->findAgencies($search);
        } elseif ($searchForLocation) {
            //1.Find properties with this search keyword
            //2. Look for agencies with that property
            $agencies = $this->findAgenciesForLocation($searchForLocation);
        } else {
            $agencies = $er->retrieveAll(
                $id,
                $limit,
                $offset,
                $withDeleted,
                $search,
                $name,
                $userId,
                $userName,
                $sortOn,
                $reverse);
        }


        if (!is_null($agencies)) {
            //set listing counts
            $listingRepo = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
            if (is_array($agencies)) {
                foreach($agencies as $agency) {
                    $agencyId = $agency->getId();
                    $listingCount = $listingRepo->fetchCount(
                    null, //$id
                    false, // $withDeleted
                    null, //$search
                    null, //$city
                    null, //$community
                    null, //$category
                    null, //$subcategory
                    null, //$type
                    $agencyId);
                    $agency->setListingCount($listingCount);
                    $soldListingCount = $listingRepo->fetchSoldCount($agencyId);
                    $agency->setSoldListings($soldListingCount);
                            
                    //with photos
                    if ($withPhotos) {
                        $agencyId = $agency->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            null, //$listingId
                            $agencyId
                        );
                        $agency->setPhotos($photos);
                    }

                    //with agents
                    if ($withAgents) {
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

                        $agentsCount = $this->agentManager->getCount(
                            null, //$id
                            null, //$withDeleted,
                            null, //$name
                            null, //$userId
                            $agencyId
                        );
                        $agency->setAgentsCount($agentsCount);
                    }
                }

            } else {
                $agencyId = $agencies->getId();
                $listingCount = $listingRepo->fetchCount(
                    null, //$id
                    false, // $withDeleted
                    null, //$search
                    null, //$city
                    null, //$community
                    null, //$category
                    null, //$subcategory
                    null, //$type
                    $agencyId);
                $agencies->setListingCount($listingCount);
                $soldListingCount = $listingRepo->fetchSoldCount($agencyId);
                $agencies->setSoldListings($soldListingCount);

                //with photos
                if ($withPhotos) {
                    $agencyId = $agencies->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        null, //$listingId
                        $agencyId
                    );

                    $agencies->setPhotos($photos);
                }

                //with agents
                if ($withAgents) {
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

                    $agentsCount = $this->agentManager->getCount(
                        null, //$id
                        null, //$withDeleted,
                        null, //$name
                        null, //$userId
                        $agencyId
                    );
                    
                    $agencies->setAgentsCount($agentsCount);

                    }
                }
            }

        return $agencies;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $search = null,
                         $name = null,
                         $userId = null,
                         $userName = null,
                         $searchForLocation=null)
    {
        if ($search) {
            $count = $this->findAgenciesCount($search);
        } else if ($searchForLocation) {
            $count = $this->findAgenciesCount(
                null, //$search
                $searchForLocation);
        } else {
            $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

            $count = $er->fetchCount(
                $id,
                $withDeleted,
                $search,
                $name,
                $userId,
                $userName);
        }

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
                group by a.id
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
                group by a.id
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

            $listingRepo = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
            $agencyId = $agency['id'];
            $listingCount = $listingRepo->fetchCount(
            null, //$id
            false, // $withDeleted
            null, //$search
            null, //$city
            null, //$community
            null, //$category
            null, //$subcategory
            null, //$type
            $agencyId);
            $hydratedAgency->setListingCount($listingCount);
            $soldListingCount = $listingRepo->fetchSoldCount($agencyId);
            $hydratedAgency->setSoldListings($soldListingCount);

            $hydratedAgencies[] = $hydratedAgency;

        }

        return $hydratedAgencies;
    }

    public function fetchContactDetails($agencyId=null) {
        if (is_null($agencyId)) {
            return null;
        }

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $agency = $er->retrieveAll($agencyId);

        $contactDetails = array();
        $phoneNumber = $agency->getPhone();
        $email = $agency->getEmail();

        $contactDetails['phone'] = $phoneNumber;
        $contactDetails['email'] = $email;

        return $contactDetails;
    }

    public function findAgencies($keyword=null) {
        /*$query = $this->legacyConnection->executeQuery('
                SELECT DISTINCT a.* from bf_company a
                 JOIN bf_listing l
                 ON a.id = l.company_id
                 and (l.city like ? 
                    or l.community like ? 
                    or l.sub_community like ?
                    or l.tower like ?)
                    ', array("%$keyword%", "%$keyword%", "%$keyword%", "%$keyword%"));*/

            $query = $this->legacyConnection->executeQuery('
                SELECT DISTINCT a.* from bf_company a
                 where a.name like ?
                 ', array("%$keyword%"));

        $data = $query->fetchAll();
        $agencies = $this->hydrate($data);

        return $agencies;
    }

    public function findAgenciesForLocation($keyword=null) {
        $query = $this->legacyConnection->executeQuery('
                SELECT DISTINCT a.* from bf_company a
                 JOIN bf_listing l
                 ON a.id = l.company_id
                 and (l.city like ? 
                    or l.community like ? 
                    or l.sub_community like ?
                    or l.tower like ?)
                    ', array("%$keyword%", "%$keyword%", "%$keyword%", "%$keyword%"));

        $data = $query->fetchAll();
        $agencies = $this->hydrate($data);

        return $agencies;
    }

    public function findAgenciesCount($keyword=null, $searchForLocation) {
        if ($searchForLocation) {
            $query = $this->legacyConnection->executeQuery('
            SELECT count(*) as count from (
                SELECT DISTINCT a.* from bf_company a
                     JOIN bf_listing l
                     ON a.id = l.company_id
                     and (l.city like ? 
                        or l.community like ? 
                        or l.sub_community like ?
                        or l.tower like ?)) as x
                        ', array("%$searchForLocation%", "%$searchForLocation%", "%$searchForLocation%", "%$searchForLocation%"));
        } else {
            $query = $this->legacyConnection->executeQuery('
            SELECT count(*) as count from (
                SELECT DISTINCT a.* from bf_company a
                 where a.name like ?) as x
                 ', array("%$keyword%"));
        }

        $data = $query->fetch();
        
        return $data['count'];
    }

}