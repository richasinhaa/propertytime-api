<?php

namespace Proxies\__CG__\Nuada\ApiBundle\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Listing extends \Nuada\ApiBundle\Entity\Listing implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setAgentId($agentId)
    {
        $this->__load();
        return parent::setAgentId($agentId);
    }

    public function getAgentId()
    {
        $this->__load();
        return parent::getAgentId();
    }

    public function setAgentName($agentName)
    {
        $this->__load();
        return parent::setAgentName($agentName);
    }

    public function getAgentName()
    {
        $this->__load();
        return parent::getAgentName();
    }

    public function setAgentEmail($agentEmail)
    {
        $this->__load();
        return parent::setAgentEmail($agentEmail);
    }

    public function getAgentEmail()
    {
        $this->__load();
        return parent::getAgentEmail();
    }

    public function setAgentPhone($agentPhone)
    {
        $this->__load();
        return parent::setAgentPhone($agentPhone);
    }

    public function getAgentPhone()
    {
        $this->__load();
        return parent::getAgentPhone();
    }

    public function setCompanyId($companyId)
    {
        $this->__load();
        return parent::setCompanyId($companyId);
    }

    public function getCompanyId()
    {
        $this->__load();
        return parent::getCompanyId();
    }

    public function setCompanyName($companyName)
    {
        $this->__load();
        return parent::setCompanyName($companyName);
    }

    public function getCompanyName()
    {
        $this->__load();
        return parent::getCompanyName();
    }

    public function setReference($reference)
    {
        $this->__load();
        return parent::setReference($reference);
    }

    public function getReference()
    {
        $this->__load();
        return parent::getReference();
    }

    public function setCity($city)
    {
        $this->__load();
        return parent::setCity($city);
    }

    public function getCity()
    {
        $this->__load();
        return parent::getCity();
    }

    public function setCommunity($community)
    {
        $this->__load();
        return parent::setCommunity($community);
    }

    public function getCommunity()
    {
        $this->__load();
        return parent::getCommunity();
    }

    public function setSubCommunity($subCommunity)
    {
        $this->__load();
        return parent::setSubCommunity($subCommunity);
    }

    public function getSubCommunity()
    {
        $this->__load();
        return parent::getSubCommunity();
    }

    public function setTower($tower)
    {
        $this->__load();
        return parent::setTower($tower);
    }

    public function getTower()
    {
        $this->__load();
        return parent::getTower();
    }

    public function setListingCategory($listingCategory)
    {
        $this->__load();
        return parent::setListingCategory($listingCategory);
    }

    public function getListingCategory()
    {
        $this->__load();
        return parent::getListingCategory();
    }

    public function setListingSubCategory($listingSubCategory)
    {
        $this->__load();
        return parent::setListingSubCategory($listingSubCategory);
    }

    public function getListingSubCategory()
    {
        $this->__load();
        return parent::getListingSubCategory();
    }

    public function setListingType($listingType)
    {
        $this->__load();
        return parent::setListingType($listingType);
    }

    public function getListingType()
    {
        $this->__load();
        return parent::getListingType();
    }

    public function setPrice($price)
    {
        $this->__load();
        return parent::setPrice($price);
    }

    public function getPrice()
    {
        $this->__load();
        return parent::getPrice();
    }

    public function setFrequency($frequency)
    {
        $this->__load();
        return parent::setFrequency($frequency);
    }

    public function getFrequency()
    {
        $this->__load();
        return parent::getFrequency();
    }

    public function setSqft($sqft)
    {
        $this->__load();
        return parent::setSqft($sqft);
    }

    public function getSqft()
    {
        $this->__load();
        return parent::getSqft();
    }

    public function setReraNumber($reraNumber)
    {
        $this->__load();
        return parent::setReraNumber($reraNumber);
    }

    public function getReraNumber()
    {
        $this->__load();
        return parent::getReraNumber();
    }

    public function setBuildYear($buildYear)
    {
        $this->__load();
        return parent::setBuildYear($buildYear);
    }

    public function getBuildYear()
    {
        $this->__load();
        return parent::getBuildYear();
    }

    public function setFloor($floor)
    {
        $this->__load();
        return parent::setFloor($floor);
    }

    public function getFloor()
    {
        $this->__load();
        return parent::getFloor();
    }

    public function setFloorNumber($floorNumber)
    {
        $this->__load();
        return parent::setFloorNumber($floorNumber);
    }

    public function getFloorNumber()
    {
        $this->__load();
        return parent::getFloorNumber();
    }

    public function setAddress($address)
    {
        $this->__load();
        return parent::setAddress($address);
    }

    public function getAddress()
    {
        $this->__load();
        return parent::getAddress();
    }

    public function setBedroom($bedroom)
    {
        $this->__load();
        return parent::setBedroom($bedroom);
    }

    public function getBedroom()
    {
        $this->__load();
        return parent::getBedroom();
    }

    public function setBathroom($bathroom)
    {
        $this->__load();
        return parent::setBathroom($bathroom);
    }

    public function getBathroom()
    {
        $this->__load();
        return parent::getBathroom();
    }

    public function setImages($images)
    {
        $this->__load();
        return parent::setImages($images);
    }

    public function getImages()
    {
        $this->__load();
        return parent::getImages();
    }

    public function setLongitude($longitude)
    {
        $this->__load();
        return parent::setLongitude($longitude);
    }

    public function getLongitude()
    {
        $this->__load();
        return parent::getLongitude();
    }

    public function setLatitude($latitude)
    {
        $this->__load();
        return parent::setLatitude($latitude);
    }

    public function getLatitude()
    {
        $this->__load();
        return parent::getLatitude();
    }

    public function setFromFeed($fromFeed)
    {
        $this->__load();
        return parent::setFromFeed($fromFeed);
    }

    public function getFromFeed()
    {
        $this->__load();
        return parent::getFromFeed();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function setDescription($description)
    {
        $this->__load();
        return parent::setDescription($description);
    }

    public function getDescription()
    {
        $this->__load();
        return parent::getDescription();
    }

    public function setCdnImages($cdnImages)
    {
        $this->__load();
        return parent::setCdnImages($cdnImages);
    }

    public function getCdnImages()
    {
        $this->__load();
        return parent::getCdnImages();
    }

    public function setIsCdn($isCdn)
    {
        $this->__load();
        return parent::setIsCdn($isCdn);
    }

    public function getIsCdn()
    {
        $this->__load();
        return parent::getIsCdn();
    }

    public function setClientId($clientId)
    {
        $this->__load();
        return parent::setClientId($clientId);
    }

    public function getClientId()
    {
        $this->__load();
        return parent::getClientId();
    }

    public function setHotListing($hotListing)
    {
        $this->__load();
        return parent::setHotListing($hotListing);
    }

    public function getHotListing()
    {
        $this->__load();
        return parent::getHotListing();
    }

    public function setFeatureListing($featureListing)
    {
        $this->__load();
        return parent::setFeatureListing($featureListing);
    }

    public function getFeatureListing()
    {
        $this->__load();
        return parent::getFeatureListing();
    }

    public function setOpenHouseListing($openHouseListing)
    {
        $this->__load();
        return parent::setOpenHouseListing($openHouseListing);
    }

    public function getOpenHouseListing()
    {
        $this->__load();
        return parent::getOpenHouseListing();
    }

    public function setXmlLockListing($xmlLockListing)
    {
        $this->__load();
        return parent::setXmlLockListing($xmlLockListing);
    }

    public function getXmlLockListing()
    {
        $this->__load();
        return parent::getXmlLockListing();
    }

    public function setPublishListing($publishListing)
    {
        $this->__load();
        return parent::setPublishListing($publishListing);
    }

    public function getPublishListing()
    {
        $this->__load();
        return parent::getPublishListing();
    }

    public function setOldPublishState($oldPublishState)
    {
        $this->__load();
        return parent::setOldPublishState($oldPublishState);
    }

    public function getOldPublishState()
    {
        $this->__load();
        return parent::getOldPublishState();
    }

    public function setVisibility($visibility)
    {
        $this->__load();
        return parent::setVisibility($visibility);
    }

    public function getVisibility()
    {
        $this->__load();
        return parent::getVisibility();
    }

    public function setApproved($approved)
    {
        $this->__load();
        return parent::setApproved($approved);
    }

    public function getApproved()
    {
        $this->__load();
        return parent::getApproved();
    }

    public function setArchived($archived)
    {
        $this->__load();
        return parent::setArchived($archived);
    }

    public function getArchived()
    {
        $this->__load();
        return parent::getArchived();
    }

    public function setTotalView($totalView)
    {
        $this->__load();
        return parent::setTotalView($totalView);
    }

    public function getTotalView()
    {
        $this->__load();
        return parent::getTotalView();
    }

    public function setLastViewed($lastViewed)
    {
        $this->__load();
        return parent::setLastViewed($lastViewed);
    }

    public function getLastViewed()
    {
        $this->__load();
        return parent::getLastViewed();
    }

    public function setCreatedOn($createdOn)
    {
        $this->__load();
        return parent::setCreatedOn($createdOn);
    }

    public function getCreatedOn()
    {
        $this->__load();
        return parent::getCreatedOn();
    }

    public function setModifiedOn($modifiedOn)
    {
        $this->__load();
        return parent::setModifiedOn($modifiedOn);
    }

    public function getModifiedOn()
    {
        $this->__load();
        return parent::getModifiedOn();
    }

    public function setCreatedBy($createdBy)
    {
        $this->__load();
        return parent::setCreatedBy($createdBy);
    }

    public function getCreatedBy()
    {
        $this->__load();
        return parent::getCreatedBy();
    }

    public function setModifiedBy($modifiedBy)
    {
        $this->__load();
        return parent::setModifiedBy($modifiedBy);
    }

    public function getModifiedBy()
    {
        $this->__load();
        return parent::getModifiedBy();
    }

    public function setDeletedBy($deletedBy)
    {
        $this->__load();
        return parent::setDeletedBy($deletedBy);
    }

    public function getDeletedBy()
    {
        $this->__load();
        return parent::getDeletedBy();
    }

    public function setDeleted($deleted)
    {
        $this->__load();
        return parent::setDeleted($deleted);
    }

    public function getDeleted()
    {
        $this->__load();
        return parent::getDeleted();
    }

    public function serialise()
    {
        $this->__load();
        return parent::serialise();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'agentId', 'agentName', 'agentEmail', 'agentPhone', 'companyId', 'companyName', 'reference', 'city', 'community', 'subCommunity', 'tower', 'listingCategory', 'listingSubCategory', 'listingType', 'price', 'frequency', 'sqft', 'reraNumber', 'buildYear', 'floor', 'floorNumber', 'address', 'bedroom', 'bathroom', 'images', 'longitude', 'latitude', 'fromFeed', 'title', 'description', 'cdnImages', 'isCdn', 'clientId', 'hotListing', 'featureListing', 'openHouseListing', 'xmlLockListing', 'publishListing', 'oldPublishState', 'visibility', 'approved', 'archived', 'totalView', 'lastViewed', 'createdOn', 'modifiedOn', 'createdBy', 'modifiedBy', 'deletedBy', 'deleted');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}