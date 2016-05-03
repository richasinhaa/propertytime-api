<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\ListingDetail
 * Uses ORM
 *
 * @ORM\Table(name="nl_listing_detail")
 * @ORM\Entity(repositoryClass="ListingDetailRepository")
 */
class ListingDetail
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $listingType
     *
     * @ORM\Column(name="listing_type", type="string")
     */
    protected $listingType;

    /**
     * @var integer count
     *
     * @ORM\Column(name="count", type="integer")
     */
    protected $count;

    /**
     * @var integer $smallImagePath
     *
     * @ORM\Column(name="small_image_path", type="string")
     */
    protected $smallImagePath;

    /**
     * @var integer $largeImagePath
     *
     * @ORM\Column(name="large_image_path", type="string")
     */
    protected $largeImagePath;

    /**
     * @var integer $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var integer $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;


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
     * Set count
     *
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set smallImagePath
     *
     * @param string $smallImagePath
     */
    public function setSmallImagePath($smallImagePath)
    {
        $this->smallImagePath = $smallImagePath;
    }

    /**
     * Get smallImagePath
     *
     * @return string 
     */
    public function getSmallImagePath()
    {
        return $this->smallImagePath;
    }

    /**
     * Set largeImagePath
     *
     * @param string $largeImagePath
     */
    public function setLargeImagePath($largeImagePath)
    {
        $this->largeImagePath = $largeImagePath;
    }

    /**
     * Get largeImagePath
     *
     * @return string 
     */
    public function getLargeImagePath()
    {
        return $this->largeImagePath;
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
     * @return deleted
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
            'id'               => $this->getId(),
            'listing_type'     => $this->getListingType(),
            'count'            => $this->getCount(),
            'small_image_path' => $this->getSmallImagePath(),
            'large_image_path' => $this->getLargeImagePath(),
            'created_at'       => $this->getCreatedAt()
        );

        return $data;
    }
}
