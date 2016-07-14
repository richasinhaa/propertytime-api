<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Log
 * Uses ORM
 *
 * @ORM\Table(name="nl_logs")
 * @ORM\Entity(repositoryClass="LogRepository")
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $propertyId
     *
     * @ORM\Column(name="property_id", type="integer")
     */
    protected $propertyId;

    /**
     * @var integer $agencyId
     *
     * @ORM\Column(name="agency_id", type="integer")
     */
    protected $agencyId;

    /**
     * @var string $search
     *
     * @ORM\Column(name="search", type="string")
     */
    protected $search;

    /**
     * @var string $searchFrom
     *
     * @ORM\Column(name="search_from", type="string")
     */
    protected $searchFrom;

    /**
     * @var boolean $contacted
     *
     * @ORM\Column(name="contacted", type="boolean")
     */
    protected $contacted;

    /**
     * @var boolean $liked
     *
     * @ORM\Column(name="liked", type="boolean")
     */
    protected $liked;

    /**
     * @var integer $userId
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;


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
     * Set propertyId
     *
     * @param integer $propertyId
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;
    }

    /**
     * Get propertyId
     *
     * @return integer 
     */
    public function getPropertyId()
    {
        return $this->propertyId;
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
     * @return integer 
     */
    public function getAgencyId()
    {
        return $this->agencyId;
    }

    /**
     * Set search
     *
     * @param string $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * Get search
     *
     * @return string 
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set searchFrom
     *
     * @param string $searchFrom
     */
    public function setSearchFrom($searchFrom)
    {
        $this->searchFrom = $searchFrom;
    }

    /**
     * Get searchFrom
     *
     * @return string 
     */
    public function getSearchFrom()
    {
        return $this->searchFrom;
    }

    /**
     * Set contacted
     *
     * @param boolean $contacted
     */
    public function setContacted($contacted)
    {
        $this->contacted = $contacted;
    }

    /**
     * Get contacted
     *
     * @return boolean 
     */
    public function getContacted()
    {
        return $this->contacted;
    }

    /**
     * Set liked
     *
     * @param boolean $liked
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;
    }

    /**
     * Get liked
     *
     * @return boolean 
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
}
