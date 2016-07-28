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
     * @var string $relevantExperience
     *
     * @ORM\Column(name="relevent_exp", type="float")
     */
    protected $relevantExperience;

    /**
     * @var string $into
     *
     * @ORM\Column(name="intro", type="string")
     */
    protected $intro;

    /**
     * @var string $facebook
     *
     * @ORM\Column(name="facebook", type="string")
     */
    protected $facebook;

    /**
     * @var string $twitter
     *
     * @ORM\Column(name="twitter", type="string")
     */
    protected $twitter;

    /**
     * @var string $google
     *
     * @ORM\Column(name="google", type="string")
     */
    protected $google;

    /**
     * @var string $linkedin
     *
     * @ORM\Column(name="linkedin", type="string")
     */
    protected $linkedin;

    /**
     * @var string $jobTitle
     *
     * @ORM\Column(name="job_title", type="string")
     */
    protected $jobTitle;




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
     * Set relevantExperience
     *
     * @param string $relevantExperience
     */
    public function setRelevantExperience($relevantExperience)
    {
        $this->relevantExperience = $relevantExperience;
    }

    /**
     * Get relevantExperience
     *
     * @return string 
     */
    public function getRelevantExperience()
    {
        return $this->relevantExperience;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * Get jobTitle
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set intro
     *
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set google
     *
     * @param string $google
     */
    public function setGoogle($google)
    {
        $this->google = $google;
    }

    /**
     * Get google
     *
     * @return string 
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * Get linkedin
     *
     * @return string 
     */
    public function getLinkedin()
    {
        return $this->linkedin;
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
            'description'  => $this->getDescription(),
            'image_path'   => $this->getImagePath(),
            'phone'        => $this->getPhone(),
            'email'        => $this->getEmail(),
            'address'      => $this->getAddress(),
            'city'         => $this->getCity(),
            'country'      => $this->getCountry(),
            'expertise'    => $this->getExpertise(),
            'created_at'   => $this->getCreatedAt(),
            'deleted'      => $this->getDeleted(),
            'relevant_experience' => $this->getRelevantExperience(),
            'job_title'           => $this->getJobTitle(),
            'one_liner_intro'     => $this->getIntro(),
            'facebook'            => $this->getFacebook(),
            'twitter'             => $this->getTwitter(),
            'google'              => $this->getGoogle(),
            'linkedin'            => $this->getLinkedin()
        );

        return $data;
    }
}
