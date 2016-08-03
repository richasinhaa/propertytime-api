<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\ContactAgency
 * Uses ORM
 *
 * @ORM\Table(name="nl_contact_agency")
 * @ORM\Entity(repositoryClass="ContactAgencyRepository")
 */
class ContactAgency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $agencyId
     *
     * @ORM\Column(name="agency_id", type="integer")
     */
    private $agencyId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;

    /**
     * @var string $customerType
     *
     * @ORM\Column(name="customer_type", type="string")
     */
    private $customerType;

    /**
     * @var string $enquiry
     *
     * @ORM\Column(name="enquiry", type="string")
     */
    private $enquiry;

    /**
     * @var boolean $keepInformed
     *
     * @ORM\Column(name="keep_informed", type="boolean")
     */
    private $keepInformed;

    /**
     * @var \DateTime $createdOn
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    private $createdOn;

    /**
     * @var \DateTime $modifiedOn
     *
     * @ORM\Column(name="modified_on", type="datetime")
     */
    private $modifiedOn;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;


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
     * Set customerType
     *
     * @param string $customerType
     */
    public function setCustomerType($customerType)
    {
        $this->customerType = $customerType;
    }

    /**
     * Get customerType
     *
     * @return string 
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * Set enquiry
     *
     * @param string $enquiry
     */
    public function setEnquiry($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Get enquiry
     *
     * @return string 
     */
    public function getEnquiry()
    {
        return $this->enquiry;
    }

    /**
     * Set keepInformed
     *
     * @param boolean $keepInformed
     */
    public function setKeepInformed($keepInformed)
    {
        $this->keepInformed = $keepInformed;
    }

    /**
     * Get keepInformed
     *
     * @return boolean 
     */
    public function getKeepInformed()
    {
        return $this->keepInformed;
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
}
