<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Agent;

class AgentManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $name = null,
            $userId = null,
            $agencyId = null,
            $sortOn = null,
            $reverse = false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $agents = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $agencyId,
            $sortOn,
            $reverse);

        return $agents;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $name = null,
                         $userId = null,
                         $agencyId = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');

        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $agencyId);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $name                = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $userId              = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $agencyId            = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
                $email               = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $position            = !empty($requestParams['position']) ? $requestParams['position'] : null;
                $publishAgentOnline  = !empty($requestParams['publish_agent_online']) 
                                        ? $requestParams['publish_agent_online'] : false;
                $phone               = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $photo               = !empty($requestParams['photo']) ? $requestParams['photo'] : null;
                $sendWelcomeEmail    = !empty($requestParams['send_welcome_email']) 
                                        ? $requestParams['send_welcome_email'] : false;
                $miscellaneous       = !empty($requestParams['miscellaneous']) 
                                        ? $requestParams['miscellaneous'] : null;
                $autoCreated         = !empty($requestParams['auto_created']) 
                                        ? $requestParams['auto_created'] : null;
                $enable              = !empty($requestParams['enable']) 
                                        ? $requestParams['enable'] : false;
                $facebookUrl        = !empty($requestParams['facebook_url']) 
                                        ? $requestParams['facebook_url'] : null;
                $instagramUrl       = !empty($requestParams['instagram_url']) 
                                        ? $requestParams['instagram_url'] : null;
                $twitterUrl         = !empty($requestParams['twitter_url']) ? $requestParams['twitter_url'] : null;
                $twitterSnippet     = !empty($requestParams['twitter_snippet']) 
                                        ? $requestParams['twitter_snippet'] : null;

                if (is_null($name) 
                    || is_null($agencyId)
                    || is_null($email)
                    || is_null($phone)) {
                    throw new BadAttributeException('Request has null value for name or agency_id or email or phone');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');
                $agent = new Agent();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $agent->setCreatedOn(new \DateTime('now'));
                    $agent->setModifiedOn(new \DateTime('now'));
                    $agent->setDeleted(false);
                    $agent->setName($name);
                    $agent->setUserId($userId);
                    $agent->setAgencyId($agencyId);
                    $agent->setPosition($position);
                    $agent->setPublishAgentOnline($publishAgentOnline);
                    $agent->setPhoto($photo);
                    $agent->setSendWelcomeEmail($sendWelcomeEmail);
                    $agent->setMiscellaneous($miscellaneous);
                    $agent->setAutoCreated($autoCreated);
                    $agent->setPhone($phone);
                    $agent->setEmail($email);
                    $agent->setFacebookUrl($facebookUrl);
                    $agent->setTwitterUrl($twitterUrl);
                    $agent->setInstagramUrl($instagramUrl);
                    $agent->setTwitterSnippet($twitterSnippet);

                    $em = $this->doctrine->getManager();
                    $em->persist($agent);
                    $em->flush();
                    $conn->commit();

                    return $agent;
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

    public function update($agent, $requestParams = null) {

    try {
            if (!empty($requestParams)) {
                $name                = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $userId              = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $agencyId            = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
                $email               = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $position            = !empty($requestParams['position']) ? $requestParams['position'] : null;
                $publishAgentOnline  = !empty($requestParams['publish_agent_online']) 
                                        ? $requestParams['publish_agent_online'] : null;
                $phone               = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $photo               = !empty($requestParams['photo']) ? $requestParams['photo'] : null;
                $sendWelcomeEmail    = !empty($requestParams['send_welcome_email']) 
                                        ? $requestParams['send_welcome_email'] : null;
                $miscellaneous       = !empty($requestParams['miscellaneous']) 
                                        ? $requestParams['miscellaneous'] : null;
                $autoCreated         = !empty($requestParams['auto_created']) 
                                        ? $requestParams['auto_created'] : null;
                $enable              = !empty($requestParams['enable']) 
                                        ? $requestParams['enable'] : null;
                $facebookUrl        = !empty($requestParams['facebook_url']) 
                                        ? $requestParams['facebook_url'] : null;
                $instagramUrl       = !empty($requestParams['instagram_url']) 
                                        ? $requestParams['instagram_url'] : null;
                $twitterUrl         = !empty($requestParams['twitter_url']) ? $requestParams['twitter_url'] : null;
                $twitterSnippet     = !empty($requestParams['twitter_snippet']) 
                                        ? $requestParams['twitter_snippet'] : null;


                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $agent->setModifiedOn(new \DateTime('now'));
                    
                    if (!is_null($name)) {
                        $agent->setName($name);
                    }
                    if (!is_null($userId)) {
                        $agent->setUserId($userId);
                    }
                    if (!is_null($agencyId)) {
                        $agent->setAgencyId($agencyId);
                    }
                    if (!is_null($position)) {
                        $agent->setPosition($position);
                    }
                    if (!is_null($publishAgentOnline)) {
                        $agent->setPublishAgentOnline($publishAgentOnline);
                    }
                    if (!is_null($photo)) {
                        $agent->setPhoto($photo);
                    }
                    if (!is_null($sendWelcomeEmail)) {
                        $agent->setSendWelcomeEmail($sendWelcomeEmail);
                    }
                    if (!is_null($miscellaneous)) {
                        $agent->setMiscellaneous($miscellaneous);
                    }
                    if (!is_null($autoCreated)) {
                        $agent->setAutoCreated($autoCreated);
                    }
                    if (!is_null($phone)) {
                        $agent->setPhone($phone);
                    }
                    if (!is_null($email)) {
                        $agent->setEmail($email);
                    }
                    if (!is_null($facebookUrl)) {
                        $agent->setFacebookUrl($facebookUrl);
                    }
                    if (!is_null($twitterUrl)) {
                        $agent->setTwitterUrl($twitterUrl);
                    }
                    if (!is_null($instagramUrl)) {
                        $agent->setInstagramUrl($instagramUrl);
                    }
                    if (!is_null($twitterSnippet)) {
                        $agent->setTwitterSnippet($twitterSnippet);
                    }

                    $em = $this->doctrine->getManager();
                    $em->persist($agent);
                    $em->flush();
                    $conn->commit();

                    return $agent;
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

            }
        } catch(Exception $e) {
            throw $e;
        }

        return null;
    }


    public function delete($agent) {
        try {
            $agent->setDeleted(true);
            $agent->setModifiedOn(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($agent);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}