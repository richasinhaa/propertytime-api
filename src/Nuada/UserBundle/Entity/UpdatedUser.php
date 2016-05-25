<?php

namespace Nuada\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\UserBundle\Entity\UpdatedUser
 * Uses ORM
 *
 * @ORM\Table(name="nl_updated_user")
 * @ORM\Entity(repositoryClass="UpdatedUserRepository")
 */
class UpdatedUser
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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string")
     */
    protected $email;

    /**
     * @var string $phoneNumber
     *
     * @ORM\Column(name="phone_number", type="string")
     */
    protected $phoneNumber;

    /**
     * @var string $adminApproved
     *
     * @ORM\Column(name="admin_approved", type="boolean")
     */
    protected $adminApproved;

    /**
     * @var string $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var string $createdAt
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    protected $modifiedAt;

    /**
     * @var string $deleted
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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set adminApproved
     *
     * @param boolean $adminApproved
     */
    public function setAdminApproved($adminApproved)
    {
        $this->adminApproved = $adminApproved;
    }

    /**
     * Get adminApproved
     *
     * @return boolean 
     */
    public function getAdminApproved()
    {
        return $this->adminApproved;
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
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
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
            'id'            => $this->getId(),
            'user_id'       => $this->getUserId(),
            'email'         => $this->getEmail(),
            'phone_number'  => $this->getPhoneNumber(),
            'admin_approved'=> $this->getAdminApproved(),
            'created_at'    => $this->getCreatedAt(),
            'modified_at'   => $this->getModifiedAt(),
            'deleted'       => $this->getDeleted()
        );

        return $data;
    }
}
