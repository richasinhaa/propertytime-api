<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\Listing;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Nuada\ApiBundle\Entity\BadAttributeException;

class ListingManager
{
    protected $doctrine;
    protected $securityContext;
    protected $agencyManager;
    protected $photoManager;
    protected $agentManager;

    

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager,
                                PhotoManager $photoManager,
                                AgentManager $agentManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
        $this->photoManager = $photoManager;
        $this->agentManager = $agentManager;
    }

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = false,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $bed = null,
            $minPrice = null,
            $maxPrice = null,
            $minArea = null,
            $maxArea = null,
            $furnishing = null,
            $agentId = null,
            $sortOn = null,
            $reverse = null,
            $withAgencies=true,
            $withPhotos=true)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');

        $properties = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $search,
            $city,
            $community,
            $category,
            $subcategory,
            $type,
            $agencyId,
            $bed,
            $minPrice,
            $maxPrice,
            $minArea,
            $maxArea,
            $furnishing,
            $agentId,
            $sortOn,
            $reverse);



    if (!is_null($properties)) {
        if (is_array($properties)) {
            foreach($properties as $property) {
                $features = $property->getFeatures();
                $description = $property->getDescription();
                if ($features) {
                    $property->setFeatures($features);
                    $description = str_replace($features, '', $description);
                    $property->setDescription($description);
                }
                //with agencies
                if ($withAgencies) {
                    $agencyId = $property->getAgencyId();
                    if (!is_null($agencyId)) {
                        $agency = $this->agencyManager->load($agencyId);
                        $property->setAgency($agency);
                    }
                }
                //with photos
                if  ($withPhotos) {
                    $listingId = $property->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        $listingId
                    );
                    $property->setPhotos($photos);
                }
            }

        } else {
            $features = $properties->getFeatures();
            $description = $properties->getDescription();
            if ($features) {
                $properties->setFeatures($features);
                $description = str_replace($features, '', $description);
                $properties->setDescription($description);
            }
            //with agencies
            if ($withAgencies) {
                $agencyId = $properties->getAgencyId();
                if (!is_null($agencyId)) {
                    $agency = $this->agencyManager->load($agencyId);
                    $properties->setAgency($agency);
                }

            }
            //with photos
            if  ($withPhotos) {
                $listingId = $properties->getId();
                $photos = $this->photoManager->load(
                    null, //$id
                    $listingId
                );
                $properties->setPhotos($photos);

            }
        }
    }

        return $properties;

    }

    public function getCount(
            $id = null,
            $withDeleted = false,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $bed = null,
            $minPrice = null,
            $maxPrice = null,
            $minArea = null,
            $maxArea = null,
            $furnishing = null,
            $agentId = null,
            $fromDate = null,
            $toDate = null) {

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        
        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $search,
            $city,
            $community,
            $category,
            $subcategory,
            $type,
            $agencyId,
            $bed,
            $minPrice,
            $maxPrice,
            $minArea,
            $maxArea,
            $furnishing,
            $agentId,
            $fromDate,
            $toDate);

        return intval($count);

    }

    public function getUnpublishedCount() {

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        
        $count = $er->getUnpublishedCount();

        return intval($count);

    }

    public function getPublishedCount() {

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        
        $count = $er->getPublishedCount();

        return intval($count);

    }

    public function getActiveCount() {

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        
        $count = $er->getActiveCount();

        return intval($count);

    }

    public function fetchSoldCount($agencyId=null) {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');

        $count = $er->fetchSoldCount($agencyId);

        return intval($count);
    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $city        = !empty($requestParams['city']) ? $requestParams['city'] : null;
                $community   = !empty($requestParams['community']) ? $requestParams['community'] : null;
                $subcommunity= !empty($requestParams['sub_community']) ? $requestParams['sub_community'] : null;
                $category    = !empty($requestParams['category']) ? $requestParams['category'] : null;
                $subcategory = !empty($requestParams['sub_category']) ? $requestParams['sub_category'] : null;
                $tower       = !empty($requestParams['tower']) ? $requestParams['tower'] : null;
                $type        = !empty($requestParams['type']) ? $requestParams['type'] : null;
                $reraNumber  = !empty($requestParams['rera_number']) ? $requestParams['rera_number'] : null;
                $agencyId    = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
                $bed         = !empty($requestParams['bedroom']) ? $requestParams['bedroom'] : null;
                $price       = !empty($requestParams['min_price']) ? $requestParams['min_price'] : null;
                $area        = !empty($requestParams['min_area']) ? $requestParams['min_area'] : null;
                $furnishing  = !empty($requestParams['furnishing']) ? $requestParams['furnishing'] : null;
                $agentId     = !empty($requestParams['agent_id']) ? $requestParams['agent_id'] : null;
                $agentName   = !empty($requestParams['agent_name']) ? $requestParams['agent_name'] : null;
                $agencyName  = !empty($requestParams['agency_name']) ? $requestParams['agency_name'] : null;
                $agentPhone  = !empty($requestParams['agent_phone']) ? $requestParams['agent_phone'] : null;
                $agentEmail  = !empty($requestParams['agent_email']) ? $requestParams['agent_email'] : null;
                $buildYear   = !empty($requestParams['build_year']) ? $requestParams['build_year'] : null;
                $floor       = !empty($requestParams['floor']) ? $requestParams['floor'] : null;
                $floorNumber = !empty($requestParams['floor_number']) ? $requestParams['floor_number'] : null;
                $address     = !empty($requestParams['address']) ? $requestParams['address'] : null;
                $bathroom    = !empty($requestParams['bathroom']) ? $requestParams['bathroom'] : null;
                $longitude   = !empty($requestParams['longitude']) ? $requestParams['longitude'] : null;
                $latitude    = !empty($requestParams['latitude']) ? $requestParams['latitude'] : null;
                $fromFeed    = !empty($requestParams['from_feed']) ? $requestParams['from_feed'] : null;
                $title       = !empty($requestParams['title']) ? $requestParams['title'] : null;
                $description = !empty($requestParams['description']) ? $requestParams['description'] : null;
                $cdnImages   = !empty($requestParams['cdn_images']) ? $requestParams['cdn_images'] : null;
                $isCdn       = !empty($requestParams['is_cdn']) ? $requestParams['is_cdn'] : false;
                $clientId    = !empty($requestParams['client_id']) ? $requestParams['client_id'] : null;
                $hotListing  = !empty($requestParams['hot_listing']) ? $requestParams['hot_listing'] : false;
                $featureListing = !empty($requestParams['feature_listing']) ? $requestParams['feature_listing'] : false;
                $openHouseListing = !empty($requestParams['open_house_listing']) ? $requestParams['open_house_listing'] : false;
                $xmlLockListing = !empty($requestParams['xml_lock_listing']) ? $requestParams['xml_lock_listing'] : false;
                $publishListing = !empty($requestParams['publish_listing']) ? $requestParams['publish_listing'] : false;
                $oldPublishState = !empty($requestParams['old_publish_state']) ? $requestParams['old_publish_state'] : false;
                $visibility  = !empty($requestParams['visibility']) ? $requestParams['visibility'] : false;
                $approved  = !empty($requestParams['approved']) ? $requestParams['approved'] : false;
                $archived  = !empty($requestParams['archived']) ? $requestParams['archived'] : false;
                $totalView = !empty($requestParams['total_view']) ? $requestParams['total_view'] : 0;
                $lastViewed = !empty($requestParams['last_viewed']) ? $requestParams['last_viewed'] : null;
                $reference  = !empty($requestParams['reference']) ? $requestParams['reference'] : null;

                if (is_null($city) 
                    || is_null($community) 
                    || is_null($category) 
                    || is_null($subcategory)
                    || is_null($type)) {
                    throw new BadAttributeException('Request has null value for city or community or category or sub_category or type');
                }

                if(is_null($agentId) && is_null($agentName)) {
                   throw new BadAttributeException('Agent details missing!'); 
                } elseif($agentId && is_null($agentName)) {
                    $agent = $this->agentManager->load($agentId);
                    if (is_null($agent)) {
                        throw new BadAttributeException('Agent with id '.$agentId. ' doesnot exist' ); 
                    }
                    $agentName = $agent->getName();
                } elseif($agentName && is_null($agentId)) {
                    $agent = $this->agentManager->load( 
                        null, //$id
                        null, //$limit
                        null, //$offset
                        null, //$withDeleted
                        $agentName); //$name
                    
                    if (empty($agent)) {
                        throw new BadAttributeException('Agent with name '.$agentName. ' doesnot exist' ); 
                    }
                    
                    $agentId = $agent[0]->getId();
                }

                if(is_null($agencyId) && is_null($agencyName)) {
                   throw new BadAttributeException('Agency details missing!'); 
                } elseif($agencyId && is_null($agencyName)) {
                    $agency = $this->agencyManager->load($agencyId);
                    if (is_null($agency)) {
                        throw new BadAttributeException('Agency with id '.$agencyId. ' doesnot exist' ); 
                    }
                    $agencyName = $agency->getName();
                } elseif($agencyName && is_null($agencyId)) {
                    $agency = $this->agencyManager->load( 
                        null, //$id
                        null, //$limit
                        null, //$offset
                        null, //$withDelete
                        null, //$search
                        $agencyName); //$name

                    if (is_null($agency)) {
                        throw new BadAttributeException('Agency with name '.$agencyName. ' doesnot exist' ); 
                    }
                    $agencyId = $agency[0]->getId();
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
                $listing = new Listing();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $listing->setCreatedOn(new \DateTime('now'));
                    $listing->setModifiedOn(new \DateTime('now'));
                    $listing->setDeleted(false);
                    $listing->setAgentId($agentId);
                    $listing->setAgentName($agentName);
                    $listing->setAgentEmail($agentEmail);
                    $listing->setAgentPhone($agentPhone);
                    $listing->setAgencyId($agencyId);
                    $listing->setAgencyName($agencyName);
                    $listing->setReference($reference);
                    $listing->setCity($city);
                    $listing->setCommunity($community);
                    $listing->setSubCommunity($subcommunity);
                    $listing->setTower($tower);
                    $listing->setListingCategory($category);
                    $listing->setListingSubCategory($subcategory);
                    $listing->setListingType($type);
                    $listing->setPrice($price);
                    $listing->setSqft($area);
                    $listing->setReraNumber($reraNumber);
                    $listing->setBuildYear($buildYear);
                    $listing->setFloor($floor);
                    $listing->setFloorNumber($floorNumber);
                    $listing->setAddress($address);
                    $listing->setBedroom($bed);
                    $listing->setBathroom($bathroom);
                    $listing->setLongitude($longitude);
                    $listing->setLatitude($latitude);
                    $listing->setFromFeed($fromFeed);
                    $listing->setTitle($title);
                    $listing->setDescription($description);
                    $listing->setIsCdn($isCdn);
                    $listing->setClientId($clientId);
                    $listing->setHotListing($hotListing);
                    $listing->setFeatureListing($featureListing);
                    $listing->setOpenHouseListing($openHouseListing);
                    $listing->setXmlLockListing($xmlLockListing);
                    $listing->setPublishListing($publishListing);
                    $listing->setOldPublishState($oldPublishState);
                    $listing->setVisibility($visibility);
                    $listing->setApproved($approved);
                    $listing->setCdnImages($cdnImages);
                    $listing->setArchived($archived);
                    $listing->setTotalView($totalView);
                    $listing->setLastViewed($lastViewed);

                    $em = $this->doctrine->getManager();
                    $em->persist($listing);
                    $em->flush();
                    $conn->commit();

                    return $listing;
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

    public function update($listing, $requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $city        = !empty($requestParams['city']) ? $requestParams['city'] : null;
                $community   = !empty($requestParams['community']) ? $requestParams['community'] : null;
                $subcommunity= !empty($requestParams['sub_community']) ? $requestParams['sub_community'] : null;
                $category    = !empty($requestParams['category']) ? $requestParams['category'] : null;
                $subcategory = !empty($requestParams['sub_category']) ? $requestParams['sub_category'] : null;
                $tower       = !empty($requestParams['tower']) ? $requestParams['tower'] : null;
                $type        = !empty($requestParams['type']) ? $requestParams['type'] : null;
                $reraNumber  = !empty($requestParams['rera_number']) ? $requestParams['rera_number'] : null;
                $agencyId    = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
                $bed         = !empty($requestParams['bedroom']) ? $requestParams['bedroom'] : null;
                $price       = !empty($requestParams['min_price']) ? $requestParams['min_price'] : null;
                $area        = !empty($requestParams['min_area']) ? $requestParams['min_area'] : null;
                $furnishing  = !empty($requestParams['furnishing']) ? $requestParams['furnishing'] : null;
                $agentId     = !empty($requestParams['agent_id']) ? $requestParams['agent_id'] : null;
                $agentName   = !empty($requestParams['agent_name']) ? $requestParams['agent_name'] : null;
                $agencyName  = !empty($requestParams['agency_name']) ? $requestParams['agency_name'] : null;
                $agentPhone  = !empty($requestParams['agent_phone']) ? $requestParams['agent_phone'] : null;
                $agentEmail  = !empty($requestParams['agent_email']) ? $requestParams['agent_email'] : null;
                $buildYear   = !empty($requestParams['build_year']) ? $requestParams['build_year'] : null;
                $floor       = !empty($requestParams['floor']) ? $requestParams['floor'] : null;
                $floorNumber = !empty($requestParams['floor_number']) ? $requestParams['floor_number'] : null;
                $address     = !empty($requestParams['address']) ? $requestParams['address'] : null;
                $bathroom    = !empty($requestParams['bathroom']) ? $requestParams['bathroom'] : null;
                $longitude   = !empty($requestParams['longitude']) ? $requestParams['longitude'] : null;
                $latitude    = !empty($requestParams['latitude']) ? $requestParams['latitude'] : null;
                $fromFeed    = !empty($requestParams['from_feed']) ? $requestParams['from_feed'] : null;
                $title       = !empty($requestParams['title']) ? $requestParams['title'] : null;
                $description = !empty($requestParams['description']) ? $requestParams['description'] : null;
                $cdnImages   = !empty($requestParams['cdn_images']) ? $requestParams['cdn_images'] : null;
                $isCdn       = !empty($requestParams['is_cdn']) ? $requestParams['is_cdn'] : null;
                $clientId    = !empty($requestParams['client_id']) ? $requestParams['client_id'] : null;
                $hotListing  = !empty($requestParams['hot_listing']) ? $requestParams['hot_listing'] : null;
                $featureListing = !empty($requestParams['feature_listing']) ? $requestParams['feature_listing'] : null;
                $openHouseListing = !empty($requestParams['open_house_listing']) ? $requestParams['open_house_listing'] : null;
                $xmlLockListing = !empty($requestParams['xml_lock_listing']) ? $requestParams['xml_lock_listing'] : null;
                $publishListing = !empty($requestParams['publish_listing']) ? $requestParams['publish_listing'] : null;
                $oldPublishState = !empty($requestParams['old_publish_state']) ? $requestParams['old_publish_state'] : null;
                $visibility  = !empty($requestParams['visibility']) ? $requestParams['visibility'] : null;
                $approved  = !empty($requestParams['approved']) ? $requestParams['approved'] : null;
                $archived  = !empty($requestParams['archived']) ? $requestParams['archived'] : null;
                $totalView = !empty($requestParams['total_view']) ? $requestParams['total_view'] : null;
                $lastViewed = !empty($requestParams['last_viewed']) ? $requestParams['last_viewed'] : null;
                $reference  = !empty($requestParams['reference']) ? $requestParams['reference'] : null;

                if($agencyId && is_null($agencyName)) {
                    $agency = $this->agencyManager->load($agencyId);
                    if (is_null($agency)) {
                        throw new BadAttributeException('Agency with id '.$agencyId. ' doesnot exist' ); 
                    }
                    $agencyName = $agency->getName();
                } elseif($agencyName && is_null($agencyId)) {
                    $agency = $this->agencyManager->load( 
                        null, //$id
                        null, //$limit
                        null, //$offset
                        null, //$withDelete
                        null, //$search
                        $agencyName); //$name

                    if (is_null($agency)) {
                        throw new BadAttributeException('Agency with name '.$agencyName. ' doesnot exist' ); 
                    }
                    $agencyId = $agency[0]->getId();
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $listing->setModifiedOn(new \DateTime('now'));
                    $listing->setDeleted(false);
                    if (!is_null($agentId)) {
                        $listing->setAgentId($agentId);
                    }
                    if (!is_null($agentId)) {
                        $listing->setAgentName($agentName);
                    }
                    if (!is_null($agentEmail)) {
                        $listing->setAgentEmail($agentEmail);
                    }
                    if (!is_null($agentPhone)) {
                        $listing->setAgentPhone($agentPhone);
                    }
                    if (!is_null($agencyId)) {
                        $listing->setAgencyId($agencyId);
                    }
                    if (!is_null($agencyName)) {
                        $listing->setAgencyName($agencyName);
                    }
                    if (!is_null($reference)) {
                        $listing->setReference($reference);
                    }
                    if (!is_null($city)) {
                        $listing->setCity($city);
                    }
                    if (!is_null($community)) {
                        $listing->setCommunity($community);
                    }
                    if (!is_null($subcommunity)) {
                        $listing->setSubCommunity($subcommunity);
                    }
                    if (!is_null($tower)) {
                        $listing->setTower($tower);
                    }
                    if (!is_null($category)) {
                        $listing->setListingCategory($category);
                    }
                    if (!is_null($subcategory)) {
                        $listing->setListingSubCategory($subcategory);
                    }
                    if (!is_null($type)) {
                        $listing->setListingType($type);
                    }
                    if (!is_null($price)) {
                        $listing->setPrice($price);
                    }
                    if (!is_null($area)) {
                        $listing->setSqft($area);
                    }
                    if (!is_null($reraNumber)) {
                        $listing->setReraNumber($reraNumber);
                    }
                    if (!is_null($buildYear)) {
                        $listing->setBuildYear($buildYear);
                    }
                    if (!is_null($floor)) {
                        $listing->setFloor($floor);
                    }
                    if (!is_null($floorNumber)) {
                        $listing->setFloorNumber($floorNumber);
                    }
                    if (!is_null($address)) {
                        $listing->setAddress($address);
                    }
                    if (!is_null($bed)) {
                        $listing->setBedroom($bed);
                    }
                    if (!is_null($bathroom)) {
                        $listing->setBathroom($bathroom);
                    }
                    if (!is_null($longitude)) {
                        $listing->setLongitude($longitude);
                    }
                    if (!is_null($latitude)) {
                        $listing->setLatitude($latitude);
                    }
                    if (!is_null($fromFeed)) {
                        $listing->setFromFeed($fromFeed);
                    }
                    if (!is_null($title)) {
                        $listing->setTitle($title);
                    }
                    if (!is_null($description)) {
                        $listing->setDescription($description);
                    }
                    if (!is_null($isCdn)) {
                        $listing->setIsCdn($isCdn);
                    }
                    if (!is_null($clientId)) {
                        $listing->setClientId($clientId);
                    }
                    if (!is_null($hotListing)) {
                        $listing->setHotListing($hotListing);
                    }
                    if (!is_null($featureListing)) {
                        $listing->setFeatureListing($featureListing);
                    }
                    if (!is_null($openHouseListing)) {
                        $listing->setOpenHouseListing($openHouseListing);
                    }
                    if (!is_null($xmlLockListing)) {
                        $listing->setXmlLockListing($xmlLockListing);
                    }
                    if (!is_null($publishListing)) {
                        $listing->setPublishListing($publishListing);
                    }
                    if (!is_null($oldPublishState)) {
                        $listing->setOldPublishState($oldPublishState);
                    }
                    if (!is_null($visibility)) {
                        $listing->setVisibility($visibility);
                    }
                    if (!is_null($approved)) {
                        $listing->setApproved($approved);
                    }
                    if (!is_null($cdnImages)) {
                        $listing->setCdnImages($cdnImages);
                    }
                    if (!is_null($archived)) {
                        $listing->setArchived($archived);
                    }
                    if (!is_null($totalView)) {
                        $listing->setTotalView($totalView);
                    }
                    if (!is_null($lastViewed)) {
                        $listing->setLastViewed($lastViewed);
                    }


                    $em = $this->doctrine->getManager();
                    $em->persist($listing);
                    $em->flush();
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }
            } 
            
            return $listing;

        } catch(Exception $e) {
            throw $e;
        }

        return null;

    }

    public function delete($listing) {
        try {
            $listing->setDeleted(true);
            $listing->setModifiedOn(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($listing);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}