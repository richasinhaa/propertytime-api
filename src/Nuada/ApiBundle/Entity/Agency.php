<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Agency
 * Uses ORM
 *
 * @ORM\Table(name="bf_company")
 * @ORM\Entity(repositoryClass="AgencyRepository")
 */
class Agency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $agentId
     *
     * @ORM\Column(name="name", type="text")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="manager_name", type="text")
     */
    protected $managerName;

    /**
     * @var string
     *
     * @ORM\Column(name="manager_position", type="text")
     */
    protected $managerPosition;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="text")
     */
    protected $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text")
     */
    protected $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="agents_allowed", type="integer")
     */
    protected $agentsAllowed;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="text")
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="text")
     */
    protected $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="text")
     */
    protected $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="text")
     */
    protected $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="type_of_feeds", type="text")
     */
    protected $typeOfFeeds;

    /**
     * @var integer
     *
     * @ORM\Column(name="master_key_feeds_url", type="text")
     */
    protected $masterKeyFeedsUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="master_key_access_code", type="text")
     */
    protected $masterKeyAccessCode;

    /**
     * @var string
     *
     * @ORM\Column(name="master_key_group_code", type="text")
     */
    protected $masterKeyGroupCode;

    /**
     * @var string
     *
     * @ORM\Column(name="other_feeds_type", type="text")
     */
    protected $otherFeedsType;

    /**
     * @var text
     *
     * @ORM\Column(name="other_feeds_url", type="text")
     */
    protected $otherFeedsUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="other_feeds_mapping", type="text")
     */
    protected $otherFeedsMapping;

    /**
     * @var string
     *
     * @ORM\Column(name="propspace_feeds_url", type="string")
     */
    protected $propspaceFeedsUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="website_url", type="text")
     */
    protected $websiteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="text")
     */
    protected $language;

    /**
     * @var string
     *
     * @ORM\Column(name="timezones", type="text")
     */
    protected $timezones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean")
     */
    protected $featured;

    /**
     * @var integer
     *
     * @ORM\Column(name="feature_listing", type="integer")
     */
    protected $featureListing;

    /**
     * @var integer
     *
     * @ORM\Column(name="open_house_listing", type="integer")
     */
    protected $openHouseListing;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish", type="boolean")
     */
    protected $publish;

    /**
     * @var boolean
     *
     * @ORM\Column(name="old_publish_state", type="boolean")
     */
    protected $oldPublishState;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    protected $createdOn;

    /**
     * @var datetime
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
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    protected $photos;

    protected $agents;

    protected $listings;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set managerName
     *
     * @param string $managerName
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;
    }

    /**
     * Get manager name
     *
     * @return string 
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    /**
     * Set manager position
     *
     * @param string $managerPosition
     */
    public function setManagerPosition($managerPosition)
    {
        $this->managerPosition = $managerPosition;
    }

    /**
     * Get manager position
     *
     * @return string 
     */
    public function getManagerPosition()
    {
        return $this->managerPosition;
    }

    /**
     * Set user id
     *
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get user id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user name
     *
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Get user name
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set agents allowed
     *
     * @param string $reference
     */
    public function setAgentsAllowed($agentsAllowed)
    {
        $this->agentsAllowed = $agentsAllowed;
    }

    /**
     * Get agents allowed
     *
     * @return string 
     */
    public function getAgentsAllowed()
    {
        return $this->agentsAllowed;
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
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * Get phone2
     *
     * @return string 
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set fax
     *
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set logo
     *
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set typeOfFeeds
     *
     * @param string $typeOfFeeds
     */
    public function setTypeOfFeeds($typeOfFeeds)
    {
        $this->typeOfFeeds = $typeOfFeeds;
    }

    /**
     * Get typeOfFeeds
     *
     * @return string 
     */
    public function getTypeOfFeeds()
    {
        return $this->typeOfFeeds;
    }

    /**
     * Set masterKeyFeedsUrl
     *
     * @param string $masterKeyFeedsUrl
     */
    public function setMasterKeyFeedsUrl($masterKeyFeedsUrl)
    {
        $this->masterKeyFeedsUrl = $masterKeyFeedsUrl;
    }

    /**
     * Get masterKeyFeedsUrl
     *
     * @return string 
     */
    public function getMasterKeyFeedsUrl()
    {
        return $this->masterKeyFeedsUrl;
    }

    /**
     * Set master key access code
     *
     * @param string $masterKeyAccessCode
     */
    public function setMasterKeyAccessCode($masterKeyAccessCode)
    {
        $this->masterKeyAccessCode = $masterKeyAccessCode;
    }

    /**
     * Get master Key Access Code
     *
     * @return string 
     */
    public function getMasterKeyAccessCode()
    {
        return $this->masterKeyAccessCode;
    }

    /**
     * Set masterKeyGroupCode
     *
     * @param string $masterKeyGroupCode
     */
    public function setMasterKeyGroupCode($masterKeyGroupCode)
    {
        $this->masterKeyGroupCode = $masterKeyGroupCode;
    }

    /**
     * Get masterKeyGroupCode
     *
     * @return string 
     */
    public function getMasterKeyGroupCode()
    {
        return $this->masterKeyGroupCode;
    }

    /**
     * Set otherFeedsType
     *
     * @param string $otherFeedsType
     */
    public function setOtherFeedsType($otherFeedsType)
    {
        $this->otherFeedsType = $otherFeedsType;
    }

    /**
     * Get otherFeedsType
     *
     * @return string 
     */
    public function getOtherFeedsType()
    {
        return $this->otherFeedsType;
    }

    /**
     * Set otherFeedsUrl
     *
     * @param string $otherFeedsUrl
     */
    public function setOtherFeedsUrl($otherFeedsUrl)
    {
        $this->otherFeedsUrl = $otherFeedsUrl;
    }

    /**
     * Get otherFeedsUrl
     *
     * @return string 
     */
    public function getOtherFeedsUrl()
    {
        return $this->otherFeedsUrl;
    }

    /**
     * Set otherFeedsMapping
     *
     * @param string $otherFeedsMapping
     */
    public function setOtherFeedsMapping($otherFeedsMapping)
    {
        $this->otherFeedsMapping = $otherFeedsMapping;
    }

    /**
     * Get otherFeedsMapping
     *
     * @return string 
     */
    public function getOtherFeedsMapping()
    {
        return $this->otherFeedsMapping;
    }

    /**
     * Set propspaceFeedsUrl
     *
     * @param string $propspaceFeedsUrl
     */
    public function setPropspaceFeedsUrl($propspaceFeedsUrl)
    {
        $this->propspaceFeedsUrl = $propspaceFeedsUrl;
    }

    /**
     * Get propspaceFeedsUrl
     *
     * @return string 
     */
    public function getPropspaceFeedsUrl()
    {
        return $this->propspaceFeedsUrl;
    }

    /**
     * Set websiteUrl
     *
     * @param string $websiteUrl
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;
    }

    /**
     * Get websiteUrl
     *
     * @return string 
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set timezones
     *
     * @param string $timezones
     */
    public function setTimezones($timezones)
    {
        $this->timezones = $timezones;
    }

    /**
     * Get timezones
     *
     * @return string 
     */
    public function getTimezones()
    {
        return $this->timezones;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * Get featured
     *
     * @return boolean 
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set featureListing
     *
     * @param integer $featureListing
     */
    public function setFeatureListing($featureListing)
    {
        $this->featureListing = $featureListing;
    }

    /**
     * Get featureListing
     *
     * @return integer 
     */
    public function getFeatureListing()
    {
        return $this->featureListing;
    }

    /**
     * Set openHouseListing
     *
     * @param integer $openHouseListing
     */
    public function setOpenHouseListing($openHouseListing)
    {
        $this->openHouseListing = $openHouseListing;
    }

    /**
     * Get openHouseListing
     *
     * @return integer 
     */
    public function getOpenHouseListing()
    {
        return $this->openHouseListing;
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
     * Set publish
     *
     * @param boolean $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * Get publish
     *
     * @return boolean 
     */
    public function getPublish()
    {
        return $this->publish;
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
     * @return string 
     */
    public function getOldPublishState()
    {
        return $this->oldPublishState;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
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
     * Set agents
     *
     * @param array $agents
     */
    public function setAgents($agents)
    {
        $this->agents = $agents;
    }

    /**
     * Get agents
     *
     * @return array
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * Set listings
     *
     * @param array $listings
     */
    public function setListings($listings)
    {
        $this->listings = $listings;
    }

    /**
     * Get listings
     *
     * @return listings
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'                     => $this->getId(),
            'name'                   => $this->getName(),
            'manager_name'           => $this->getManagerName(),
            'manager_position'       => $this->getManagerPosition(),
            'user_id'                => $this->getUserId(),
            'user_name'              => $this->getUserName(),
            'email'                  => $this->getEmail(),
            'agents_allowed'         => $this->getAgentsAllowed(),
            'address'                => $this->getAddress(),
            'phone'                  => $this->getPhone(),
            'phone2'                 => $this->getPhone2(),
            'fax'                    => $this->getFax(),
            'logo'                   => $this->getLogo(),
            'type_of_feeds'          => $this->getTypeOfFeeds(),
            'master_key_feeds_url'   => $this->getMasterKeyFeedsUrl(),
            'master_key_access_code' => $this->getMasterKeyAccessCode(),
            'master_key_group_code'  => $this->getMasterKeyGroupCode(),
            'other_feeds_type'       => $this->getOtherFeedsType(),
            'other_feeds_url'        => $this->getOtherFeedsUrl(),
            'other_feeds_mapping'    => $this->getOtherFeedsMapping(),
            'propspace_feeds_url'    => $this->getPropspaceFeedsUrl(),
            'website_url'            => $this->getWebsiteUrl(),
            'language'               => $this->getLanguage(),
            'timezones'              => $this->getTimezones(),
            'featured'               => $this->getFeatured(),
            'feature_listing'        => $this->getFeatureListing(),
            'open_house_listing'     => $this->getOpenHouseListing(),
            'description'            => $this->getDescription(),
            'title'                  => $this->getTitle(),
            'description'            => $this->getDescription(),
            'publish'                => $this->getPublish(),
            'old_publish_state'      => $this->getOldPublishState(),
            'enable'                 => $this->getEnable(),
            'created_on'             => $this->getCreatedOn(),
            'modified_on'            => $this->getModifiedOn(),
            'created_by'             => $this->getCreatedBy(),
            'modified_by'            => $this->getModifiedBy(),
            'deleted_by'             => $this->getDeletedBy(),
            'deleted'                => $this->getDeleted(),
            'photos'                 => $this->getPhotos(),
            'agents'                 => $this->getAgents()
        );

        if (!empty($listings)) {
            $data['listings'] = $listings;
        }

        return $data;
    }
}
