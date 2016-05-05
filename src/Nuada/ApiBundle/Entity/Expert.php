<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Expert
 * Uses ORM
 *
 * @ORM\Table(name="nl_experts")
 * @ORM\Entity(repositoryClass="ExpertRepository")
 */
class Expert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string $profile
     *
     * @ORM\Column(name="profile", type="string")
     */
    protected $profile;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var string $imagePath
     *
     * @ORM\Column(name="image_path", type="string")
     */
    protected $imagePath;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string")
     */
    protected $phone;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string")
     */
    protected $email;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string")
     */
    protected $address;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string")
     */
    protected $city;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string")
     */
    protected $country;

    /**
     * @var string $expertise
     *
     * @ORM\Column(name="expertise", type="string")
     */
    protected $expertise;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var boolean $deleted
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
     * Set name
     *
     * @param string $name
     * @return Expert
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
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
     * Set profile
     *
     * @param string $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get profile
     *
     * @return string 
     */
    public function getProfile()
    {
        return $this->profile;
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
     * Set imagePath
     *
     * @param string $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
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
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set expertise
     *
     * @param string $expertise
     */
    public function setExpertise($expertise)
    {
        $this->expertise = $expertise;
    }

    /**
     * Get expertise
     *
     * @return string 
     */
    public function getExpertise()
    {
        return $this->expertise;
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
            'id'           => $this->getId(),
            'name'         => $this->getName(),
            'profile'      => $this->getProfile(),
            'description'  => $this->getDescription(),
            'image_path'   => $this->getImagePath(),
            'phone'        => $this->getPhone(),
            'email'        => $this->getEmail(),
            'address'      => $this->getAddress(),
            'city'         => $this->getCity(),
            'country'      => $this->getCountry(),
            'expertise'    => $this->getExpertise(),
            'created_at'   => $this->getCreatedAt(),
            'deleted'      => $this->getDeleted()
        );

        return $data;
    }
}
