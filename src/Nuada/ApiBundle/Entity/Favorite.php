<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Proxies\__CG__\Nuada\ApiBundle\Entity\Listing;

/**
 * Nuada\ApiBundle\Entity\Favorite
 * Uses ORM
 *
 * @ORM\Table(name="nl_favorites")
 * @ORM\Entity(repositoryClass="FavoriteRepository")
 */
class Favorite
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $userId
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * @var string $listingId
     *
     * @ORM\Column(name="listing_id", type="integer")
     */
    protected $listingId;

    /**
     * @var string $liked
     *
     * @ORM\Column(name="liked", type="boolean")
     */
    protected $liked;

    /**
     * @var \DateTime $createdOn
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    protected $createdOn;

    /**
     * @var \DateTime $modifiedOn
     *
     * @ORM\Column(name="modified_on", type="datetime")
     */
    protected $modifiedOn;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @var Listing $listing
     */
    protected $listing;


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
     * Set userId
     *
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set listingId
     *
     * @param integer $listingId
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;
    }

    /**
     * Get listingId
     *
     * @return integer 
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * Set listing
     *
     * @param array $listing
     */
    public function setListing($listing)
    {
        $this->listing = $listing;
    }

    /**
     * Get listing
     *
     * @return array 
     */
    public function getListing()
    {
        return $this->listing;
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
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'         => $this->getId(),
            'user_id'    => $this->getUserId(),
            'listing_id' => $this->getListingId(),
            'liked'      => $this->getLiked(),
            'created_on' => $this->getCreatedOn(),
            'modified_on'=> $this->getModifiedOn(),
            'deleted'    => $this->getDeleted(),
            'listing'    => $this->getListing()
        );

        return $data;
    }
}
