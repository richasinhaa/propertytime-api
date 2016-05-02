<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Summary
 * Uses ORM
 *
 * @ORM\Table(name="nl_summary")
 * @ORM\Entity(repositoryClass="SummaryRepository")
 */
class Summary
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $properties
     *
     * @ORM\Column(name="properties", type="integer")
     */
    protected $properties;

    /**
     * @var integer $users
     *
     * @ORM\Column(name="users", type="integer")
     */
    protected $users;

    /**
     * @var integer $propertiesAddedInLast24Hours
     *
     * @ORM\Column(name="properties_added_last_24_hours", type="integer")
     */
    protected $propertiesAddedInLast24Hours;

    /**
     * @var integer $propertiesSoldOrRented
     *
     * @ORM\Column(name="properties_sold_or_rented", type="integer")
     */
    protected $propertiesSoldOrRented;

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
     * Set propertyCount
     *
     * @param integer $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * Get propertyCount
     *
     * @return integer 
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set users
     *
     * @param integer $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * Get users
     *
     * @return integer 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set propertiesAddedInLast24Hours
     *
     * @param integer $propertiesAddedInLast24Hours
     */
    public function setPropertiesAddedInLast24Hours($propertiesAddedInLast24Hours)
    {
        $this->propertiesAddedInLast24Hours = $propertiesAddedInLast24Hours;
    }

    /**
     * Get propertiesAddedInLast24Hours
     *
     * @return integer 
     */
    public function getPropertiesAddedInLast24Hours()
    {
        return $this->propertiesAddedInLast24Hours;
    }

    /**
     * Set propertiesSoldOrRented
     *
     * @param integer $propertiesSoldOrRented
     */
    public function setPropertiesSoldOrRented($propertiesSoldOrRented)
    {
        $this->propertiesSoldOrRented = $propertiesSoldOrRented;
    }

    /**
     * Get propertiesSoldOrRented
     *
     * @return integer 
     */
    public function getPropertiesSoldOrRented()
    {
        return $this->propertiesSoldOrRented;
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
     * Get propertiesSoldOrRented
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


     /**
     * Serialise
     *
     * @return array
     */
    public function serialise()
    {
        $data = array(
            'id'                        => $this->getId(),
            'properties'                => $this->getProperties(),
            'users'                     => $this->getUsers(),
            'properties_in_24_hours'    => $this->getPropertiesAddedInLast24Hours(),
            'properties_sold_or_rented' => $this->getPropertiesSoldOrRented()
        );

        return $data;
    }
}
