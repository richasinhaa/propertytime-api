<?php
// src/AppBundle/Entity/User.php

namespace Nuada\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="bf_user")
 * @ORM\Entity(repositoryClass="UserRepository")
 *
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

     /**
     * @var string $userType
     *
     * @ORM\Column(name="user_type", type="string")
     */
    protected $userType;


    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string")
     */
    protected $phone;

     /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string")
     */
    protected $salt;	

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string")
     */
    protected $password;   

    /**
     * @var boolean $locked
     *
     * @ORM\Column(name="locked", type="string")
     */
    protected $locked; 

    /**
     * @var boolean $expired
     *
     * @ORM\Column(name="expired", type="string")
     */
    protected $locked;   

    /**
     * @var string $roles
     *
     * @ORM\Column(name="roles", type="string")
     */
    protected $roles;  

    /**
     * @var boolean $credentialsExpired
     *
     * @ORM\Column(name="credentials_expired", type="string")
     */
    protected $credentialsExpired; 


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

     /**
     * Set userType
     *
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * Get userType
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->userType;
    }

     /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

     /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

     /**
     * Set locked
     *
     * @param boolean $locked
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

     /**
     * Set expired
     *
     * @param boolean $expired
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;
    }

     /**
     * Set roles
     *
     * @param string $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

     /**
     * Set credentialsExpired
     *
     * @param string $credentialsExpired
     */
    public function setCredentialsExpired($credentialsExpired)
    {
        $this->credentialsExpired = $credentialsExpired;
    }
}
