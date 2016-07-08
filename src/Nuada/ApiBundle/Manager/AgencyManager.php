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


        if ($search && is_null($id)) {
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
                    $searchForLocation, //$search
                    null, //$city
                    null, //$community
                    null, //$category
                    null, //$subcategory
                    null, //$type
                    $agencyId);
                    $agency->setListingCount($listingCount);
                    $soldListingCount = $listingRepo->fetchSoldCount($agencyId, $searchForLocation);
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
                    $searchForLocation, //$search
                    null, //$city
                    null, //$community
                    null, //$category
                    null, //$subcategory
                    null, //$type
                    $agencyId);
                $agencies->setListingCount($listingCount);
                $soldListingCount = $listingRepo->fetchSoldCount($agencyId, $searchForLocation);
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

        $hydratedAgencies = $this->hydrate($agencies, $neighbourhood);

        return $hydratedAgencies;
    }

    public function hydrate($agencies, $search=null) {
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
            $search, //$search
            null, //$city
            null, //$community
            null, //$category
            null, //$subcategory
            null, //$type
            $agencyId);
            $hydratedAgency->setListingCount($listingCount);
            $soldListingCount = $listingRepo->fetchSoldCount($agencyId, $search);
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

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $name                = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $managerName         = !empty($requestParams['manager_name']) 
                                       ? $requestParams['manager_name'] : null;
                $managerPosition     = !empty($requestParams['manager_position']) 
                                       ? $requestParams['manager_position'] : null;
                $userId              = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $userName            = !empty($requestParams['user_name']) ? $requestParams['user_name'] : null;
                $email               = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $agentsAllowed       = !empty($requestParams['agents_allowed']) 
                                       ? $requestParams['agents_allowed'] : false;
                $address             = !empty($requestParams['address']) ? $requestParams['address'] : null;
                $phone               = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $phone2              = !empty($requestParams['phone2']) ? $requestParams['phone2'] : null;
                $fax                 = !empty($requestParams['fax']) ? $requestParams['fax'] : null;
                $logo                = !empty($requestParams['logo']) ? $requestParams['logo'] : null;
                $typeOfFeeds         = !empty($requestParams['type_of_feeds']) 
                                        ? $requestParams['type_of_feeds'] : null;
                $masterKeyFeedsUrl   = !empty($requestParams['master_key_feeds_url']) 
                                        ? $requestParams['master_key_feeds_url'] : null;
                $masterKeyAccessCode = !empty($requestParams['master_key_access_code']) 
                                        ? $requestParams['master_key_access_code'] : null;
                $masterKeyGroupCode  = !empty($requestParams['master_key_group_code']) 
                                        ? $requestParams['master_key_group_code'] : null;
                $otherFeedsType      = !empty($requestParams['other_feeds_type']) 
                                        ? $requestParams['other_feeds_type'] : null;
                $otherFeedsUrl       = !empty($requestParams['other_feeds_url']) 
                                        ? $requestParams['other_feeds_url'] : null;
                $otherFeedsMapping   = !empty($requestParams['other_feeds_mapping']) 
                                        ? $requestParams['other_feeds_mapping'] : null;
                $propspaceFeedsUrl   = !empty($requestParams['propspace_feeds_url']) 
                                        ? $requestParams['propspace_feeds_url'] : null;
                $websiteUrl          = !empty($requestParams['website_url']) 
                                        ? $requestParams['website_url'] : null;
                $language            = !empty($requestParams['language']) ? $requestParams['language'] : null;
                $timezones           = !empty($requestParams['timezones']) ? $requestParams['timezones'] : null;
                $featured            = !empty($requestParams['featured']) ? $requestParams['featured'] : null;
                $featureListing      = !empty($requestParams['feature_listing']) 
                                        ? $requestParams['feature_listing'] : null;
                $openHouseListing    = !empty($requestParams['open_house_listing']) 
                                        ? $requestParams['open_house_listing'] : null;
                $description         = !empty($requestParams['description']) 
                                        ? $requestParams['description'] : null;
                $publish             = !empty($requestParams['publish']) ? $requestParams['publish'] : false;
                $oldPublishState     = !empty($requestParams['old_publish_state']) 
                                        ? $requestParams['old_publish_state'] : null;
                $enable              = !empty($requestParams['enable']) ? $requestParams['enable'] : false;
                $score               = !empty($requestParams['score']) ? $requestParams['score'] : null;

                if (is_null($name) 
                    || is_null($managerName)
                    || is_null($managerPosition)
                    || is_null($userId) 
                    || is_null($userName)
                    || is_null($email)
                    || is_null($phone)
                    || is_null($typeOfFeeds)) {
                    throw new BadAttributeException('Request has null value for name or manager_name or manager_position or user_id or user_name or email or phone or type_of_feeds');
                }

                if (is_null($masterKeyFeedsUrl) 
                    && is_null($otherFeedsUrl) 
                    && is_null($propspaceFeedsUrl)) {
                    throw new BadAttributeException('Request has null value for master_key_feeds_url and other_feeds_url and propspace_feeds_url. Atleast one should be non-null');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');
                $agency = new Agency();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $agency->setCreatedOn(new \DateTime('now'));
                    $agency->setModifiedOn(new \DateTime('now'));
                    $agency->setDeleted(false);
                    $agency->setName($name);
                    $agency->setManagerName($managerName);
                    $agency->setManagerPosition($managerPosition);
                    $agency->setUserId($userId);
                    $agency->setUserName($userName);
                    $agency->setAgentsAllowed($agentsAllowed);
                    $agency->setAddress($address);
                    $agency->setLogo($logo);
                    $agency->setTypeOfFeeds($typeOfFeeds);
                    $agency->setMasterKeyFeedsUrl($masterKeyFeedsUrl);
                    $agency->setMasterKeyAccessCode($masterKeyAccessCode);
                    $agency->setMasterKeyGroupCode($masterKeyGroupCode);
                    $agency->setOtherFeedsType($otherFeedsType);
                    $agency->setOtherFeedsUrl($otherFeedsUrl);
                    $agency->setOtherFeedsMapping($otherFeedsMapping);
                    $agency->setPropspaceFeedsUrl($propspaceFeedsUrl);
                    $agency->setWebsiteUrl($websiteUrl);
                    $agency->setLanguage($language);
                    $agency->setTimezones($timezones);
                    $agency->setFeatured($featured);
                    $agency->setFeatureListing($featureListing);
                    $agency->setOpenHouseListing($openHouseListing);
                    $agency->setDescription($description);
                    $agency->setPublish($publish);
                    $agency->setOldPublishState($oldPublishState);
                    $agency->setEnable($enable);
                    $agency->setEmail($email);
                    $agency->setPhone($phone);
                    $agency->setPhone2($phone2);
                    $agency->setScore($score);

                    $em = $this->doctrine->getManager();
                    $em->persist($agency);
                    $em->flush();
                    $conn->commit();

                    return $agency;
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

            } else {
                throw new BadAttributeException('Empty request parameters');
            }
        } catch(Exception $e) {
            throw $e;
        }

        return null;

    }

        public function update($agency, $requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $name                = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $managerName         = !empty($requestParams['manager_name']) 
                                       ? $requestParams['manager_name'] : null;
                $managerPosition     = !empty($requestParams['manager_position']) 
                                       ? $requestParams['manager_position'] : null;
                $userId              = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $userName            = !empty($requestParams['user_name']) ? $requestParams['user_name'] : null;
                $email               = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $agentsAllowed       = !empty($requestParams['agents_allowed']) 
                                       ? $requestParams['agents_allowed'] : null;
                $address             = !empty($requestParams['address']) ? $requestParams['address'] : null;
                $phone               = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $phone2              = !empty($requestParams['phone2']) ? $requestParams['phone2'] : null;
                $fax                 = !empty($requestParams['fax']) ? $requestParams['fax'] : null;
                $logo                = !empty($requestParams['logo']) ? $requestParams['logo'] : null;
                $typeOfFeeds         = !empty($requestParams['type_of_feeds']) 
                                        ? $requestParams['type_of_feeds'] : null;
                $masterKeyFeedsUrl   = !empty($requestParams['master_key_feeds_url']) 
                                        ? $requestParams['master_key_feeds_url'] : null;
                $masterKeyAccessCode = !empty($requestParams['master_key_access_code']) 
                                        ? $requestParams['master_key_access_code'] : null;
                $masterKeyGroupCode  = !empty($requestParams['master_key_group_code']) 
                                        ? $requestParams['master_key_group_code'] : null;
                $otherFeedsType      = !empty($requestParams['other_feeds_type']) 
                                        ? $requestParams['other_feeds_type'] : null;
                $otherFeedsUrl       = !empty($requestParams['other_feeds_url']) 
                                        ? $requestParams['other_feeds_url'] : null;
                $otherFeedsMapping   = !empty($requestParams['other_feeds_mapping']) 
                                        ? $requestParams['other_feeds_mapping'] : null;
                $propspaceFeedsUrl   = !empty($requestParams['propspace_feeds_url']) 
                                        ? $requestParams['propspace_feeds_url'] : null;
                $websiteUrl          = !empty($requestParams['website_url']) 
                                        ? $requestParams['website_url'] : null;
                $language            = !empty($requestParams['language']) ? $requestParams['language'] : null;
                $timezones           = !empty($requestParams['timezones']) ? $requestParams['timezones'] : null;
                $featured            = !empty($requestParams['featured']) ? $requestParams['featured'] : null;
                $featureListing      = !empty($requestParams['feature_listing']) 
                                        ? $requestParams['feature_listing'] : null;
                $openHouseListing    = !empty($requestParams['open_house_listing']) 
                                        ? $requestParams['open_house_listing'] : null;
                $description         = !empty($requestParams['description']) 
                                        ? $requestParams['description'] : null;
                $publish             = !empty($requestParams['publish']) ? $requestParams['publish'] : null;
                $oldPublishState     = !empty($requestParams['old_publish_state']) 
                                        ? $requestParams['old_publish_state'] : null;
                $enable              = !empty($requestParams['enable']) ? $requestParams['enable'] : null;
                $score               = !empty($requestParams['score']) ? $requestParams['score'] : null;


                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $agency->setModifiedOn(new \DateTime('now'));
                    
                    if (!is_null($name)) {
                        $agency->setName($name);
                    }
                    if (!is_null($managerName)) {
                        $agency->setManagerName($managerName);
                    }
                    if (!is_null($managerPosition)) {
                        $agency->setManagerPosition($managerPosition);
                    }
                    if (!is_null($userId)) {
                        $agency->setUserId($userId);
                    }
                    if (!is_null($userName)) {
                        $agency->setUserName($userName);
                    }
                    if (!is_null($email)) {
                        $agency->setEmail($email);
                    }
                    if (!is_null($phone)) {
                        $agency->setPhone($phone);
                    }
                    if (!is_null($phone2)) {
                        $agency->setPhone2($phone2);
                    }
                    if (!is_null($fax)) {
                        $agency->setFax($fax);
                    }
                    if (!is_null($logo)) {
                        $agency->setLogo($logo);
                    }
                    if (!is_null($typeOfFeeds)) {
                        $agency->setTypeOfFeeds($typeOfFeeds);
                    }
                    if (!is_null($masterKeyFeedsUrl)) {
                        $agency->setMasterKeyFeedsUrl($masterKeyFeedsUrl);
                    }
                    if (!is_null($masterKeyAccessCode)) {
                        $agency->setMasterKeyAccessCode($masterKeyAccessCode);
                    }
                    if (!is_null($masterKeyGroupCode)) {
                        $agency->setMasterKeyGroupCode($masterKeyGroupCode);
                    }
                    if (!is_null($otherFeedsType)) {
                        $agency->setOtherFeedsType($otherFeedsType);
                    }
                    if (!is_null($otherFeedsUrl)) {
                        $agency->setOtherFeedsUrl($otherFeedsUrl);
                    }
                    if (!is_null($otherFeedsMapping)) {
                        $agency->setOtherFeedsMapping($otherFeedsMapping);
                    }
                    if (!is_null($propspaceFeedsUrl)) {
                        $agency->setPropspaceFeedsUrl($propspaceFeedsUrl);
                    }
                    if (!is_null($websiteUrl)) {
                        $agency->setWebsiteUrl($websiteUrl);
                    }
                    if (!is_null($language)) {
                        $agency->setLanguage($language);
                    }
                    if (!is_null($timezones)) {
                        $agency->setTimezones($timezones);
                    }
                    if (!is_null($featured)) {
                        $agency->setFeatured($featured);
                    }
                    if (!is_null($featureListing)) {
                        $agency->setFeatureListing($featureListing);
                    }
                    if (!is_null($openHouseListing)) {
                        $agency->setOpenHouseListing($openHouseListing);
                    }
                    if (!is_null($description)) {
                        $agency->setDescription($description);
                    }
                    if (!is_null($publish)) {
                        $agency->setPublish($publish);
                    }
                    if (!is_null($oldPublishState)) {
                        $agency->setOldPublishState($oldPublishState);
                    }
                    if (!is_null($enable)) {
                        $agency->setEnable($enable);
                    }
                    if (!is_null($score)) {
                        $agency->setScore($score);
                    }


                    $em = $this->doctrine->getManager();
                    $em->persist($agency);
                    $em->flush();
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }
            } 
            
            return $agency;

        } catch(Exception $e) {
            throw $e;
        }

        return null;
    }


    public function delete($agency) {
        try {
            $agency->setDeleted(true);
            $agency->setModifiedOn(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($agency);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}