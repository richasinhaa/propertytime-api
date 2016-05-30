<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nuada\ApiBundle\Entity\Review
 * Uses ORM
 *
 * @ORM\Table(name="nl_reviews")
 * @ORM\Entity(repositoryClass="ReviewRepository")
 */
class Review
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer agencyId
     *
     * @ORM\Column(name="agency_id", type="integer")
     */
    protected $agencyId;

    /**
     * @var integer $agentId
     *
     * @ORM\Column(name="agent_id", type="integer")
     */
    protected $agentId;

    /**
     * @var string $agentName
     *
     * @ORM\Column(name="agent_name", type="string")
     */
    protected $agentName;

    /**
     * @var string $customerName
     *
     * @ORM\Column(name="customer_name", type="string")
     */
    protected $customerName;

    /**
     * @var string $nationality
     *
     * @ORM\Column(name="nationality", type="string")
     */
    protected $nationality;

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
     * @var string $reviewTitle
     *
     * @ORM\Column(name="review_title", type="string")
     */
    protected $reviewTitle;

    /**
     * @var string $reviewDescription
     *
     * @ORM\Column(name="review_desc", type="string")
     */
    protected $reviewDescription;

    /**
     * @var integer $rating
     *
     * @ORM\Column(name="rating", type="integer")
     */
    protected $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer")
     */
    protected $fileId;

    /**
     * @var boolean $adminApproved
     *
     * @ORM\Column(name="admin_approved", type="boolean")
     */
    protected $adminApproved;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var float $professionalism
     *
     * @ORM\Column(name="professionalism", type="float")
     */
    protected $professionalism;

    /**
     * @var float $localMarketKnowledge
     *
     * @ORM\Column(name="local_market_knowledge", type="float")
     */
    protected $localMarketKnowledge;

    /**
     * @var float $responsiveness
     *
     * @ORM\Column(name="responsiveness", type="float")
     */
    protected $responsiveness;

    /**
     * @var float $processExpertise
     *
     * @ORM\Column(name="process_expertise", type="float")
     */
    protected $processExpertise;

    /**
     * @var float $afterSalesService
     *
     * @ORM\Column(name="after_sales_service", type="float")
     */
    protected $afterSalesService;

    /**
     * @var \DateTime $modifiedAt
     *
     * @ORM\Column(name="modified_at", type="datetime")
     */
    protected $modifiedAt;

    protected $agency;

    protected $agent;


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
     * Set agentId
     *
     * @param integer $agentId
     */
    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
    }

    /**
     * Get agentId
     *
     * @return integer 
     */
    public function getAgentId()
    {
        return $this->agentId;
    }

    /**
     * Set agentName
     *
     * @param string $agentName
     */
    public function setAgentName($agentName)
    {
        $this->agentName = $agentName;
    }

    /**
     * Get agentName
     *
     * @return string 
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * Get customerName
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
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
     * Set reviewTitle
     *
     * @param string $reviewTitle
     */
    public function setReviewTitle($reviewTitle)
    {
        $this->reviewTitle = $reviewTitle;
    }

    /**
     * Get reviewTitle
     *
     * @return string 
     */
    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }

    /**
     * Set reviewDescription
     *
     * @param string $reviewDescription
     */
    public function setReviewDescription($reviewDescription)
    {
        $this->reviewDescription = $reviewDescription;
    }

    /**
     * Get reviewDescription
     *
     * @return string 
     */
    public function getReviewDescription()
    {
        return $this->reviewDescription;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set fileId
     *
     * @param integer $fileId
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * Get fileId
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->fileId;
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
     * Set agency
     *
     * @param Agency $agency
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * Get agency
     *
     * @return Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Set agent
     *
     * @param Agent $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }

    /**
     * Get agent
     *
     * @return Agent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set professionalism
     *
     * @param float $professionalism
     */
    public function setProfessionalism($professionalism)
    {
        $this->professionalism = $professionalism;
    }

    /**
     * Get professionalism
     *
     * @return float 
     */
    public function getProfessionalism()
    {
        return $this->professionalism;
    }

    /**
     * Set localMarketKnowledge
     *
     * @param float $localMarketKnowledge
     */
    public function setLocalMarketKnowledge($localMarketKnowledge)
    {
        $this->localMarketKnowledge = $localMarketKnowledge;
    }

    /**
     * Get localMarketKnowledge
     *
     * @return float 
     */
    public function getLocalMarketKnowledge()
    {
        return $this->localMarketKnowledge;
    }

    /**
     * Set responsiveness
     *
     * @param float $responsiveness
     */
    public function setResponsiveness($responsiveness)
    {
        $this->responsiveness = $responsiveness;
    }

    /**
     * Get responsiveness
     *
     * @return float 
     */
    public function getResponsiveness()
    {
        return $this->responsiveness;
    }

    /**
     * Set processExpertise
     *
     * @param float $processExpertise
     */
    public function setProcessExpertise($processExpertise)
    {
        $this->processExpertise = $processExpertise;
    }

    /**
     * Get processExpertise
     *
     * @return float 
     */
    public function getProcessExpertise()
    {
        return $this->processExpertise;
    }

    /**
     * Set afterSalesService
     *
     * @param float $afterSalesService
     */
    public function setAfterSalesService($afterSalesService)
    {
        $this->afterSalesService = $afterSalesService;
    }

    /**
     * Get afterSalesService
     *
     * @return float 
     */
    public function getAfterSalesService()
    {
        return $this->afterSalesService;
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
            'agency_id'              => $this->getAgencyId(),
            'agency'                 => $this->getAgency(),
            'agent_id'               => $this->getAgentId(),
            'agent_name'             => $this->getAgentName(),
            'agent'                  => $this->getAgent(),
            'customer_name'          => $this->getCustomerName(),
            'nationality'            => $this->getNationality(),
            'phone'                  => $this->getPhone(),
            'email'                  => $this->getEmail(),
            'review_title'           => $this->getReviewTitle(),
            'review_description'     => $this->getReviewDescription(),
            'rating'                 => $this->getRating(),
            'professionalism'        => $this->getProfessionalism(),
            'local_market_knowledge' => $this->getLocalMarketKnowledge(),
            'responsiveness'         => $this->getResponsiveness(),
            'process_expertise'      => $this->getProcessExpertise(),
            'after_sales_service'    => $this->getAfterSalesService(),
            'file_id'                => $this->getFileId(),
            'admin_approved'         => $this->getAdminApproved(),
            'deleted'                => $this->getDeleted(),
            'created_at'             => $this->getCreatedAt(),
            'modified_at'            => $this->getModifiedAt(),
        );

        return $data;
    }
}
