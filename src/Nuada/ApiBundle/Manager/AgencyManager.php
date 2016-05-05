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
            $withAgents=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;


        if ($search) {
            //1.Find properties with this search keyword
            //2. Look for agencies with that property
            $agencies = $this->findAgencies($search);
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
                         $search = null,
                         $name = null,
                         $userId = null,
                         $userName = null)
    {
        if ($search) {
            $count = $this->findAgenciesCount($search);
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

    public function findAgenciesCount($keyword=null) {
        $query = $this->legacyConnection->executeQuery('
        SELECT count(*) as count from (
            SELECT DISTINCT a.* from bf_company a
                 JOIN bf_listing l
                 ON a.id = l.company_id
                 and (l.city like ? 
                    or l.community like ? 
                    or l.sub_community like ?
                    or l.tower like ?)) as x
                    ', array("%$keyword%", "%$keyword%", "%$keyword%", "%$keyword%"));

        $data = $query->fetch();

        return $data['count'];
    }

}