<?php
// src/AppBundle/Entity/User.php

namespace Nuada\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="bf_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

 	/**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;	
     
     /**
     * @ORM\Column(type="string", length=15)
     *
     * @Assert\NotBlank(message="Please enter your Mobile Number.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=10,
     *     max=15,
     *     minMessage="Please enter a valid Mobile Number.",
     *     maxMessage="Please enter a valid Mobile Number.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $phone;	

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_USER');
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

	public function setEmail($email){
	    $this->email = $email;
	    $this->username = $email;
	}

	public function setEmailCanonical($emailCanonical){
	    $this->emailCanonical = $emailCanonical;
	    $this->usernameCanonical = $emailCanonical;
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
}
