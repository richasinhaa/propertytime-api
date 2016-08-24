<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Agent
 * Uses ORM
 *
 * @ORM\Table(name="bf_agent")
 * @ORM\Entity(repositoryClass="AgentRepository")
 */
class Agent
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
     * @var integer
     */
    protected $userId;

    /**
     * @var string agencyId
     *
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $agencyId;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string")
     */
    protected $email;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string")
     */
    protected $position;

    /**
     * @var boolean $publishAgentOnline
     *
     * @ORM\Column(name="publish_agent_online", type="boolean")
     */
    protected $publishAgentOnline;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string")
     */
    protected $phone;

    /**
     * @var string $photo
     *
     * @ORM\Column(name="photo", type="string")
     */
    protected $photo;

    /**
     * @var boolean $sendWelcomeEmail
     *
     * @ORM\Column(name="send_welcome_email", type="boolean")
     */
    protected $sendWelcomeEmail;

    /**
     * @var string $miscellaneous
     *
     * @ORM\Column(name="miscellaneous", type="text")
     */
    protected $miscellaneous;

    /**
     * @var boolean $autoCreated
     *
     * @ORM\Column(name="auto_created", type="boolean")
     */
    protected $autoCreated;

    /**
     * @var boolean $enable
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable;

    /**
     * @var \Datetime $createdOn
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    protected $createdOn;

    /**
     * @var integer $createdBy
     *
     * @ORM\Column(name="created_by", type="integer")
     */
    protected $createdBy;

    /**
     * @var \DateTime $modifiedOn
     *
     * @ORM\Column(name="modified_on", type="datetime")
     */
    protected $modifiedOn;

    /**
     * @var integer $modifiedBy
     *
     * @ORM\Column(name="modified_by", type="integer")
     */
    protected $modifiedBy;

    /**
     * @var integer $deletedBy
     *
     * @ORM\Column(name="deleted_by", type="integer")
     */
    protected $deletedBy;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @var string $facebookUrl
     *
     * @ORM\Column(name="facebook_url", type="string")
     */
    protected $facebookUrl;

    /**
     * @var string $instagramUrl
     *
     * @ORM\Column(name="instagram_url", type="string")
     */
    protected $instagramUrl;

    /**
     * @var string $twitterUrl
     *
     * @ORM\Column(name="twitter_url", type="string")
     */
    protected $twitterUrl;

    /**
     * @var text $twitterSnippet
     *
     * @ORM\Column(name="twitter_snippet", type="text")
     */
    protected $twitterSnippet;


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
     * Set position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set publishAgentOnline
     *
     * @param boolean $publishAgentOnline
     */
    public function setPublishAgentOnline($publishAgentOnline)
    {
        $this->publishAgentOnline = $publishAgentOnline;
    }

    /**
     * Get publishAgentOnline
     *
     * @return boolean 
     */
    public function getPublishAgentOnline()
    {
        return $this->publishAgentOnline;
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
     * Set photo
     *
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set sendWelcomeEmail
     *
     * @param boolean $sendWelcomeEmail
     */
    public function setSendWelcomeEmail($sendWelcomeEmail)
    {
        $this->sendWelcomeEmail = $sendWelcomeEmail;
    }

    /**
     * Get sendWelcomeEmail
     *
     * @return boolean 
     */
    public function getSendWelcomeEmail()
    {
        return $this->sendWelcomeEmail;
    }

    /**
     * Set miscellaneous
     *
     * @param string $miscellaneous
     */
    public function setMiscellaneous($miscellaneous)
    {
        $this->miscellaneous = $miscellaneous;
    }

    /**
     * Get miscellaneous
     *
     * @return string 
     */
    public function getMiscellaneous()
    {
        return $this->miscellaneous;
    }

    /**
     * Set autoCreated
     *
     * @param boolean $autoCreated
     */
    public function setAutoCreated($autoCreated)
    {
        $this->autoCreated = $autoCreated;
    }

    /**
     * Get autoCreated
     *
     * @return boolean 
     */
    public function getAutoCreated()
    {
        return $this->autoCreated;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
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
     * Set facebookUrl
     *
     * @param string $facebookUrl
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    }

    /**
     * Get facebookUrl
     *
     * @return string 
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Set instagramUrl
     *
     * @param string $instagramUrl
     */
    public function setInstagramUrl($instagramUrl)
    {
        $this->instagramUrl = $instagramUrl;
    }

    /**
     * Get instagramUrl
     *
     * @return string 
     */
    public function getInstagramUrl()
    {
        return $this->instagramUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    }

    /**
     * Get twitterUrl
     *
     * @return string 
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Set twitterSnippet
     *
     * @param string $twitterSnippet
     */
    public function setTwitterSnippet($twitterSnippet)
    {
        $this->twitterSnippet = $twitterSnippet;
    }

    /**
     * Get twitterSnippet
     *
     * @return string 
     */
    public function getTwitterSnippet()
    {
        return $this->twitterSnippet;
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
            'name'                   => $this->getName(),
            'user_id'                => $this->getUserId(),
            'agency_id'              => $this->getAgencyId(),
            'position'               => $this->getPosition(),
            'publish_agent_online'   => $this->getPublishAgentOnline(),
            'photo'                  => $this->getPhoto(),
            'send_welcome_email'     => $this->getSendWelcomeEmail(),
            'miscellaneous'          => $this->getMiscellaneous(),
            'auto_created'           => $this->getAutoCreated(),
            'enable'                 => $this->getEnable(),
            'created_on'             => $this->getCreatedOn(),
            'modified_on'            => $this->getModifiedOn(),
            'created_by'             => $this->getCreatedBy(),
            'modified_by'            => $this->getModifiedBy(),
            'deleted_by'             => $this->getDeletedBy(),
            'deleted'                => $this->getDeleted(),
            'email'                  => $this->getEmail(),
            'facebook_url'           => $this->getFaceboolUrl(),
            'instagram_url'          => $this->getInstagramUrl(),
            'twitter_url'            => $this->getTwitterUrl(),
            'twitter_snippet'        => $this->getTwitterSnippet()
        );

        return $data;
    }
}
