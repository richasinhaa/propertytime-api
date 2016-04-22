<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Listingdetail
 * Uses ORM
 *
 * @ORM\Table(name="nl_listing_detail")
 * @ORM\Entity(repositoryClass="ListingdetailRepository")
 */
class Listingdetail
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $listingId
     *
     * @ORM\Column(name="listing_id", type="integer")
     */
    protected $listingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer")
     */
    protected $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="image_loc", type="text")
     */
    protected $imageLoc;

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
     * Set image id
     *
     * @param integer $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

    /**
     * Get image id
     *
     * @return integer 
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set image location
     *
     * @param string $imageLoc
     */
    public function setImageLoc($imageLoc)
    {
        $this->imageLoc = $imageLoc;
    }

    /**
     * Get image location
     *
     * @return string 
     */
    public function getImageLoc()
    {
        return $this->imageLoc;
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
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'                     => $this->getId(),
            'listingId'              => $this->getListingId(),
            'photoId'                => $this->getImageId(),
            'photo'                  => $this->getImageLoc(),
            'created_on'             => $this->getCreatedOn(),
            'modified_on'            => $this->getModifiedOn(),
            'created_by'             => $this->getCreatedBy(),
            'modified_by'            => $this->getModifiedBy(),
            'deleted_by'             => $this->getDeletedBy(),
            'deleted'                => $this->getDeleted(),
        );

        return $data;
    }
}
