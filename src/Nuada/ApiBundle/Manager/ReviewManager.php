<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Review;

class ReviewManager
{
    protected $doctrine;
    protected $securityContext;
    protected $agencyManager;
    protected $agentManager;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager,
                                AgentManager $agentManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
        $this->agentManager = $agentManager;
    }

    public function load($id=null,
                         $limit=null,
                         $offset=null,
                         $agencyId=null,
                         $agentId=null,
                         $agentName=null,
                         $rating=null,
                         $withDeleted=false,
                         $from=null,
                         $to=null,
                         $withAgency=false,
                         $withAgent=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Review');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $reviews = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $agencyId,
            $agentId,
            $agentName,
            $rating,
            $withDeleted,
            $from,
            $to,
            $withAgency,
            $withAgent
        );

        //with agency
        if ($withAgency) {
            if (is_array($reviews)) {
                foreach ($reviews as $review) {
                    $agencyId = $review->getAgencyId();
                    $agency = $this->agencyManager->load($agencyId);
                    $review->setAgency($agency);
                }
            } else {
                $agencyId = $reviews->getAgencyId();
                $agency = $this->agencyManager->load($agencyId);
                $reviews->setAgency($agency);
            }
        }

        //with agent
        if ($withAgent) {
            if (is_array($reviews)) {
                foreach ($reviews as $review) {
                    $agentId = $review->getAgentId();
                    if ($agentId) {
                        $agent = $this->agentManager->load($agentId);
                        $review->setAgent($agent);
                    }
                }
            } else {
                $agentId = $reviews->getAgentId();
                if ($agentId) {
                    $agent = $this->agentManager->load($agentId);
                    $reviews->setAgent($agent);
                }
            }
        }

        return $reviews;

    }

    public function getCount(
        $id=null,
        $agencyId=null,
        $agentId=null,
        $agentName=null,
        $rating=null,
        $withDeleted=false,
        $from=null,
        $to=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Review');

        $count = $er->fetchCount(
            $id,
            $agencyId,
            $agentId,
            $agentName,
            $rating,
            $withDeleted,
            $from,
            $to);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $agencyId        = !empty($requestParams['agency_id']) 
                    ? $requestParams['agency_id'] : null;
                $agentId         = !empty($requestParams['agent_id']) 
                    ? $requestParams['agent_id'] : null;
                $agentName       = !empty($requestParams['agent_name']) 
                    ? $requestParams['agent_name'] : null;
                $customerName    = !empty($requestParams['customer_name']) 
                    ? $requestParams['customer_name'] : null;
                $nationality     = !empty($requestParams['nationality']) 
                    ? $requestParams['nationality'] : null;
                $phone           = !empty($requestParams['phone']) 
                    ? $requestParams['phone'] : null;
                $email           = !empty($requestParams['email']) 
                    ? $requestParams['email'] : null;
                $reviewTitle     = !empty($requestParams['review_title']) 
                    ? $requestParams['review_title'] : null;
                $reviewDesc      = !empty($requestParams['review_description']) 
                    ? $requestParams['review_description'] : null;
                $rating          = !empty($requestParams['rating']) 
                    ? $requestParams['rating'] : null;
                $fileId          = !empty($requestParams['file_id']) 
                    ? $requestParams['file_id'] : null;
                $adminApproved   = !empty($requestParams['admin_approved']) 
                    ? $requestParams['admin_approved'] : false;
                $professionalism = !empty($requestParams['professionalism']) 
                    ? $requestParams['professionalism'] : null;
                $localMarketKnowledge = !empty($requestParams['local_market_knowledge']) 
                    ? $requestParams['local_market_knowledge'] : null;
                $responsiveness = !empty($requestParams['responsiveness']) 
                    ? $requestParams['responsiveness'] : null;
                $processExpertise = !empty($requestParams['process_expertise']) 
                    ? $requestParams['process_expertise'] : null;
                $afterSalesService = !empty($requestParams['after_sales_service']) 
                    ? $requestParams['after_sales_service'] : null;


                if (empty($agencyId)) {
                    throw new BadAttributeException('Request has null value for agency id');
                } else {
                    $agency = $this->agencyManager->load($agencyId);
                    if (is_null($agency)) {
                        throw new BadAttributeException('agency with id '. $agencyId . ' doesnot exist');
                    }
                }

                if (empty($agentId) && empty($agentName)) {
                    throw new BadAttributeException('Request cannot have null value for both agent id and agent name');
                } else if(!empty($agentId)) {
                    $agent = $this->agentManager->load($agentId);
                    if (is_null($agent)) {
                        throw new BadAttributeException('agent with id '. $agentId . ' doesnot exist');
                    }
                }

                if (empty($customerName) || empty($email) || empty($phone)) {
                    throw new BadAttributeException('Customer name, phone and email cannot be null');
                }
                if (empty($reviewDesc) || str_word_count($reviewDesc) < 50) {
                    throw new BadAttributeException('Review cannot be less than 50 words');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Review');
                $review = new Review();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $review->setCreatedAt(new \DateTime('now'));
                    $review->setModifiedAt(new \DateTime('now'));
                    $review->setDeleted(false);
                    $review->setAgencyId($agencyId);
                    $review->setAgentId($agentId);
                    $review->setAgentName($agentName);
                    $review->setCustomerName($customerName);
                    $review->setNationality($nationality);
                    $review->setPhone($phone);
                    $review->setEmail($email);
                    $review->setReviewTitle($reviewTitle);
                    $review->setReviewDescription($reviewDesc);
                    $review->setRating($rating);
                    $review->setFileId($fileId);
                    $review->setAdminApproved($adminApproved);
                    $review->setProfessionalism($professionalism);
                    $review->setLocalMarketKnowledge($localMarketKnowledge);
                    $review->setResponsiveness($responsiveness);
                    $review->setProcessExpertise($processExpertise);
                    $review->setAfterSalesService($afterSalesService);

                    $em = $this->doctrine->getManager();
                    $em->persist($review);
                    $em->flush();
                    $conn->commit();

                    return $review;
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

            } else {
                throw new BadAttributeException('Empty request parameters');
            }
        } catch(Exception $e) {
            throw $e;
        }

        return null;

    }

    public function delete($review) {
        try {
            $review->setDeleted(true);
            $review->setModifiedAt(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($review);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}