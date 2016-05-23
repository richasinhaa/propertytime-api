<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\UserAgency;

class UserAgencyManager
{
    protected $doctrine;
    protected $securityContext;
    protected $agencyManager;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
    }

    public function load($id=null,
                         $limit=null,
                         $offset=null,
                         $userId=null,
                         $agencyId=null,
                         $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:UserAgency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $userAgencies = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $userId,
            $agencyId,
            $withDeleted
        );
        
        if (!is_null($userAgencies)) {
            foreach ($userAgencies as $userAgency) {
                $agencyId = $userAgency->getAgencyId();
                $agency = $this->agencyManager->load(
                    $agencyId,
                    null, //$limit
                    null, //$offset 
                    null, //$withDeleted
                    null, //$search
                    null, //$name
                    null, //$userId
                    null, //$userName
                    null, //$sortOn
                    false, //$reverse
                    false, //$withPhotos
                    false //$withAgents
                    );
                $userAgency->setAgency($agency);
            }
        }

        return $userAgencies;

    }

    public function getCount(
        $id=null,
        $userId=null,
        $agencyId=null,
        $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:UserAgency');

        $count = $er->fetchCount(
            $id,
            $userId,
            $agencyId,
            $withDeleted);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId   = $requestParams['user_id'] ? $requestParams['user_id'] : null;
                $agencyId = $requestParams['agency_id'] ? $requestParams['agency_id'] : null;

                if (is_null($userId) || is_null($agencyId)) {
                    throw new BadAttributeException('Request has null value for user_id or agency_id');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:UserAgency');
                $userAgency = new UserAgency();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $userAgency->setCreatedAt(new \DateTime('now'));
                    $userAgency->setDeleted(false);
                    $userAgency->setUserId($userId);
                    $userAgency->setAgencyId($agencyId);

                    $em = $this->doctrine->getManager();
                    $em->persist($userAgency);
                    $em->flush();
                    $conn->commit();

                    return $userAgency;
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
}