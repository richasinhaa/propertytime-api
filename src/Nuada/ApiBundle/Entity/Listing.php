<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Listing
 * Uses ORM
 *
 * @ORM\Table(name="bf_listing")
 * @ORM\Entity(repositoryClass="ListingRepository")
 */
class Listing
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $agentId
     *
     * @ORM\Column(name="agent_id", type="integer")
     */
    protected $agentId;

    /**
     * @var string
     *
     * @ORM\Column(name="agent_name", type="text")
     */
    protected $agentName;

    /**
     * @var string
     *
     * @ORM\Column(name="agent_email", type="text")
     */
    protected $agentEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="agent_phone", type="text")
     */
    protected $agentPhone;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $agencyId;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="text")
     */
    protected $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text")
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="community", type="text")
     */
    protected $community;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_community", type="text")
     */
    protected $subCommunity;

    /**
     * @var string
     *
     * @ORM\Column(name="tower", type="text")
     */
    protected $tower;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category", type="text")
     */
    protected $listingCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_sub_category", type="text")
     */
    protected $listingSubCategory;

    /**
     * @var string
     * @ORM\Column(name="listing_type", type="text")
     */
    protected $listingType;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(name="frequency", type="text")
     */
    protected $frequency;

    /**
     * @var float
     *
     * @ORM\Column(name="sq_ft", type="decimal")
     */
    protected $sqft;

    /**
     * @var string
     *
     * @ORM\Column(name="rera_number", type="text")
     */
    protected $reraNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="build_year", type="integer")
     */
    protected $buildYear;

    /**
     * @var integer
     *
     * @ORM\Column(name="floor", type="integer")
     */
    protected $floor;

    /**
     * @var integer
     *
     * @ORM\Column(name="floor_number", type="integer")
     */
    protected $floorNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="bedroom", type="text")
     */
    protected $bedroom;

    /**
     * @var string
     *
     * @ORM\Column(name="bathroom", type="text")
     */
    protected $bathroom;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="text")
     */
    protected $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="text")
     */
    protected $latitude;

    /**
     * @var boolean
     *
     * @ORM\Column(name="from_feed", type="boolean")
     */
    protected $fromFeed;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    protected $title;

    /**
     * @var description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_cdn", type="boolean")
     */
    protected $isCdn;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    protected $clientId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hot_listing", type="boolean")
     */
    protected $hotListing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="feature_listing", type="boolean")
     */
    protected $featureListing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="open_house_listing", type="boolean")
     */
    protected $openHouseListing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="xml_lock_listing", type="boolean")
     */
    protected $xmlLockListing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish_listing", type="boolean")
     */
    protected $publishListing;

    /**
     * @var boolean
     *
     * @ORM\Column(name="old_publish_state", type="boolean")
     */
    protected $oldPublishState;

    /**
     * @var string
     *
     * @ORM\Column(name="visibility", type="boolean")
     */
    protected $visibility;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean")
     */
    protected $approved;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    protected $archived;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_view", type="boolean")
     */
    protected $totalView;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_viewed", type="datetime")
     */
    protected $lastViewed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime")
     */
    protected $modifiedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer")
     */
    protected $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer")
     */
    protected $modifiedBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted_by", type="integer")
     */
    protected $deletedBy;

    /**
     * @var agencyName
     *
     * @ORM\Column(name="company_name", type="string")
     */
    protected $agencyName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @var text
     *
     * @ORM\Column(name="images", type="string")
     */
    protected $cdnImages;

    protected $agency;

    protected $photos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_sold", type="boolean")
     */
    protected $isSold;

    protected $features;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set agentId
     *
     * @param integer $agentId
     */
    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
    }

    /**
     * Get agentId
     *
     * @return integer 
     */
    public function getAgentId()
    {
        return $this->agentId;
    }

    /**
     * Set agentName
     *
     * @param string $agentName
     */
    public function setAgentName($agentName)
    {
        $this->agentName = $agentName;
    }

    /**
     * Get agentName
     *
     * @return string 
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * Set agentEmail
     *
     * @param string $agentEmail
     */
    public function setAgentEmail($agentEmail)
    {
        $this->agentEmail = $agentEmail;
    }

    /**
     * Get agentEmail
     *
     * @return string 
     */
    public function getAgentEmail()
    {
        return $this->agentEmail;
    }

    /**
     * Set agentPhone
     *
     * @param string $agentPhone
     */
    public function setAgentPhone($agentPhone)
    {
        $this->agentPhone = $agentPhone;
    }

    /**
     * Get agentPhone
     *
     * @return string 
     */
    public function getAgentPhone()
    {
        return $this->agentPhone;
    }

    /**
     * Set agencyId
     *
     * @param integer $agencyId
     */
    public function setAgencyId($agencyId)
    {
        $this->agencyId = $agencyId;
    }

    /**
     * Get agencyId
     *
     * @return string 
     */
    public function getAgencyId()
    {
        return $this->agencyId;
    }

    /**
     * Set reference
     *
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set community
     *
     * @param string $community
     */
    public function setCommunity($community)
    {
        $this->community = $community;
    }

    /**
     * Get community
     *
     * @return string 
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * Set subCommunity
     *
     * @param string $subCommunity
     */
    public function setSubCommunity($subCommunity)
    {
        $this->subCommunity = $subCommunity;
    }

    /**
     * Get subCommunity
     *
     * @return string 
     */
    public function getSubCommunity()
    {
        return $this->subCommunity;
    }

    /**
     * Set tower
     *
     * @param string $tower
     */
    public function setTower($tower)
    {
        $this->tower = $tower;
    }

    /**
     * Get tower
     *
     * @return string 
     */
    public function getTower()
    {
        return $this->tower;
    }

    /**
     * Set listingCategory
     *
     * @param string $listingCategory
     */
    public function setListingCategory($listingCategory)
    {
        $this->listingCategory = $listingCategory;
    }

    /**
     * Get listingCategory
     *
     * @return string 
     */
    public function getListingCategory()
    {
        return $this->listingCategory;
    }

    /**
     * Set listingSubCategory
     *
     * @param string $listingSubCategory
     */
    public function setListingSubCategory($listingSubCategory)
    {
        $this->listingSubCategory = $listingSubCategory;
    }

    /**
     * Get listingSubCategory
     *
     * @return string 
     */
    public function getListingSubCategory()
    {
        return $this->listingSubCategory;
    }

    /**
     * Set listingType
     *
     * @param string $listingType
     */
    public function setListingType($listingType)
    {
        $this->listingType = $listingType;
    }

    /**
     * Get listingType
     *
     * @return string 
     */
    public function getListingType()
    {
        return $this->listingType;
    }

    /**
     * Set price
     *
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set frequency
     *
     * @param string $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * Get frequency
     *
     * @return string 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set sqft
     *
     * @param float $sqft
     */
    public function setSqft($sqft)
    {
        $this->sqft = $sqft;
    }

    /**
     * Get sqft
     *
     * @return float 
     */
    public function getSqft()
    {
        return $this->sqft;
    }

    /**
     * Set reraNumber
     *
     * @param string $reraNumber
     */
    public function setReraNumber($reraNumber)
    {
        $this->reraNumber = $reraNumber;
    }

    /**
     * Get reraNumber
     *
     * @return string 
     */
    public function getReraNumber()
    {
        return $this->reraNumber;
    }

    /**
     * Set buildYear
     *
     * @param integer $buildYear
     */
    public function setBuildYear($buildYear)
    {
        $this->buildYear = $buildYear;
    }

    /**
     * Get buildYear
     *
     * @return integer 
     */
    public function getBuildYear()
    {
        return $this->buildYear;
    }

    /**
     * Set floor
     *
     * @param integer $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * Get floor
     *
     * @return integer 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set floorNumber
     *
     * @param integer $floorNumber
     */
    public function setFloorNumber($floorNumber)
    {
        $this->floorNumber = $floorNumber;
    }

    /**
     * Get floorNumber
     *
     * @return integer 
     */
    public function getFloorNumber()
    {
        return $this->floorNumber;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set bedroom
     *
     * @param string $bedroom
     */
    public function setBedroom($bedroom)
    {
        $this->bedroom = $bedroom;
    }

    /**
     * Get bedroom
     *
     * @return string 
     */
    public function getBedroom()
    {
        return $this->bedroom;
    }

    /**
     * Set bathroom
     *
     * @param string $bathroom
     */
    public function setBathroom($bathroom)
    {
        $this->bathroom = $bathroom;
    }

    /**
     * Get bathroom
     *
     * @return string 
     */
    public function getBathroom()
    {
        return $this->bathroom;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set fromFeed
     *
     * @param boolean $fromFeed
     */
    public function setFromFeed($fromFeed)
    {
        $this->fromFeed = $fromFeed;
    }

    /**
     * Get fromFeed
     *
     * @return boolean 
     */
    public function getFromFeed()
    {
        return $this->fromFeed;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isCdn
     *
     * @param boolean $isCdn
     */
    public function setIsCdn($isCdn)
    {
        $this->isCdn = $isCdn;
    }

    /**
     * Get isCdn
     *
     * @return boolean 
     */
    public function getIsCdn()
    {
        return $this->isCdn;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set hotListing
     *
     * @param boolean $hotListing
     */
    public function setHotListing($hotListing)
    {
        $this->hotListing = $hotListing;
    }

    /**
     * Get hotListing
     *
     * @return boolean 
     */
    public function getHotListing()
    {
        return $this->hotListing;
    }

    /**
     * Set featureListing
     *
     * @param boolean $featureListing
     */
    public function setFeatureListing($featureListing)
    {
        $this->featureListing = $featureListing;
    }

    /**
     * Get featureListing
     *
     * @return boolean 
     */
    public function getFeatureListing()
    {
        return $this->featureListing;
    }

    /**
     * Set openHouseListing
     *
     * @param boolean $openHouseListing
     */
    public function setOpenHouseListing($openHouseListing)
    {
        $this->openHouseListing = $openHouseListing;
    }

    /**
     * Get openHouseListing
     *
     * @return boolean 
     */
    public function getOpenHouseListing()
    {
        return $this->openHouseListing;
    }

    /**
     * Set xmlLockListing
     *
     * @param boolean $xmlLockListing
     */
    public function setXmlLockListing($xmlLockListing)
    {
        $this->xmlLockListing = $xmlLockListing;
    }

    /**
     * Get xmlLockListing
     *
     * @return boolean 
     */
    public function getXmlLockListing()
    {
        return $this->xmlLockListing;
    }

    /**
     * Set publishListing
     *
     * @param boolean $publishListing
     */
    public function setPublishListing($publishListing)
    {
        $this->publishListing = $publishListing;
    }

    /**
     * Get publishListing
     *
     * @return boolean 
     */
    public function getPublishListing()
    {
        return $this->publishListing;
    }

    /**
     * Set oldPublishState
     *
     * @param boolean $oldPublishState
     */
    public function setOldPublishState($oldPublishState)
    {
        $this->oldPublishState = $oldPublishState;
    }

    /**
     * Get oldPublishState
     *
     * @return boolean 
     */
    public function getOldPublishState()
    {
        return $this->oldPublishState;
    }

    /**
     * Set visibility
     *
     * @param string $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * Get visibility
     *
     * @return string 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * Get archived
     *
     * @return boolean 
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set totalView
     *
     * @param integer $totalView
     */
    public function setTotalView($totalView)
    {
        $this->totalView = $totalView;
    }

    /**
     * Get totalView
     *
     * @return integer 
     */
    public function getTotalView()
    {
        return $this->totalView;
    }

    /**
     * Set lastViewed
     *
     * @param \DateTime $lastViewed
     */
    public function setLastViewed($lastViewed)
    {
        $this->lastViewed = $lastViewed;
    }

    /**
     * Get lastViewed
     *
     * @return \DateTime 
     */
    public function getLastViewed()
    {
        return $this->lastViewed;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set modifiedOn
     *
     * @param \DateTime $modifiedOn
     */
    public function setModifiedOn($modifiedOn)
    {
        $this->modifiedOn = $modifiedOn;
    }

    /**
     * Get modifiedOn
     *
     * @return \DateTime 
     */
    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set modifiedBy
     *
     * @param integer $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * Get modifiedBy
     *
     * @return integer 
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * Set deletedBy
     *
     * @param integer $deletedBy
     */
    public function setDeletedBy($deletedBy)
    {
        $this->deletedBy = $deletedBy;
    }

    /**
     * Get deletedBy
     *
     * @return integer 
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set cdnImages
     *
     * @param text $cdnImages
     */
    public function setCdnImages($cdnImages)
    {
        $this->cdnImages = $cdnImages;
    }

    /**
     * Get cdnImages
     *
     * @return text 
     */
    public function getCdnImages()
    {
        return $this->cdnImages;
    }

    /**
     * Set agency
     *
     * @param Agency $agency
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * Get agency
     *
     * @return Agency 
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Set photos
     *
     * @param array $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * Get photos
     *
     * @return array
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set isSold
     *
     * @param boolean $isSold
     */
    public function setIsSold($isSold)
    {
        $this->isSold = $isSold;
    }

    /**
     * Get isSold
     *
     * @return boolean
     */
    public function getIsSold()
    {
        return $this->isSold;
    }

    /**
     * Get agencyName
     *
     * @return string 
     */
    public function getAgencyName()
    {
        return $this->agencyName;
    }

    /**
     * Set agencyName
     *
     * @param string $agencyName
     */
    public function setAgencyName($agencyName)
    {
        $this->agencyName = $agencyName;
    }

    /**
     * Get features
     *
     * @return string 
     */
    public function getFeatures()
    {
        $description = $this->getDescription();
        $features= null;
        $position = strpos($this->getDescription(), 'PROPERTY FEATURES');
        if ($description and ($position !== false)) {
            $features = substr($description, $position);
        }

        return $features;
    }

    /**
     * Set features
     *
     * @param string $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'                   => $this->getId(),
            'agent_id'             => $this->getAgentId(),
            'agent_name'           => $this->getAgentName(),
            'agent_email'          => $this->getAgentEmail(),
            'agent_phone'          => $this->getAgentPhone(),
            'agency_id'            => $this->getAgencyId(),
            'agency'               => $this->getAgency(),
            'reference'            => $this->getReference(),
            'city'                 => $this->getCity(),
            'community'            => $this->getCommunity(),
            'sub_community'        => $this->getSubCommunity(),
            'tower'                => $this->getTower(),
            'listing_category'     => $this->getListingCategory(),
            'listing_sub_category' => $this->getListingSubCategory(),
            'listing_type'         => $this->getListingType(),
            'price'                => $this->getPrice(),
            'frequency'            => $this->getFrequency(),
            'sq_ft'                => $this->getSqft(),
            'rera_number'          => $this->getReraNumber(),
            'build_year'           => $this->getBuildYear(),
            'floor'                => $this->getFloor(),
            'floor_number'         => $this->getFloorNumber(),
            'address'              => $this->getAddress(),
            'bedroom'              => $this->getBedroom(),
            'bathroom'             => $this->getBathroom(),
            'longitude'            => $this->getLongitude(),
            'latitude'             => $this->getLatitude(),
            'from_feed'            => $this->getFromFeed(),
            'title'                => $this->getTitle(),
            'description'          => $this->getDescription(),
            'features'             => $this->getFeatures(),
            'is_cdn'               => $this->getIsCdn(),
            'client_id'            => $this->getClientId(),
            'hot_listing'          => $this->getHotListing(),
            'feature_listing'      => $this->getFeatureListing(),
            'open_house_listing'   => $this->getOpenHouseListing(),
            'xml_lock_listing'     => $this->getXmlLockListing(),
            'publish_listing'      => $this->getPublishListing(),
            'old_publish_state'    => $this->getOldPublishState(),
            'visibility'           => $this->getVisibility(),
            'approved'             => $this->getApproved(),
            'cdn_images'           => $this->getCdnImages(),
            'archived'             => $this->getArchived(),
            'total_view'           => $this->getTotalView(),
            'last_viewed'          => $this->getLastViewed(),
            'created_on'           => $this->getCreatedOn(),
            'modified_on'          => $this->getModifiedOn(),
            'created_by'           => $this->getCreatedBy(),
            'modified_by'          => $this->getModifiedBy(),
            'deleted_by'           => $this->getDeletedBy(),
            'deleted'              => $this->getDeleted(),
            'photos'               => $this->getPhotos(),
            'is_sold'              => $this->getIsSold()
        );

        return $data;
    }
}
