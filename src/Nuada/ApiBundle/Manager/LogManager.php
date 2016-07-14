<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Log;

class LogManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 100;
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
            $id=null,
            $limit=null,
            $offset=null,
            $userId=null,
            $listingId=null,
            $agencyId=null,
            $search=null,
            $searchFrom=null,
            $contacted=null,
            $liked=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Log');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $logs = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $userId,
            $listingId,
            $agencyId,
            $search,
            $searchFrom,
            $contacted,
            $liked
        );

        return $logs;

    }

    public function getCount(
            $id=null,
            $userId=null,
            $listingId=null,
            $agencyId=null,
            $search=null,
            $searchFrom=null,
            $contacted=null,
            $liked=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Log');

        $count = $er->fetchCount(
            $id,
            $userId,
            $listingId,
            $agencyId,
            $search,
            $searchFrom,
            $contacted,
            $liked);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId      = $requestParams['user_id'] ? $requestParams['user_id'] : null;
                $listingId   = $requestParams['listing_id'] ? $requestParams['listing_id'] : null;
                $agencyId    = $requestParams['agency_id'] ? $requestParams['agency_id'] : null;
                $search      = $requestParams['search'] ? $requestParams['search'] : null;
                $searchFrom  = $requestParams['search_from'] ? $requestParams['search_from'] : null;
                $contacted   = $requestParams['contacted'] ? $requestParams['contacted'] : null;
                $liked       = $requestParams['liked'] ? $requestParams['liked'] : null;

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Log');
                $log = new Log();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $log->setCreatedAt(new \DateTime('now'));
                    $log->setUserId($userId);
                    $log->setPropertyId($listingId);
                    $log->setAgencyId($agencyId);
                    $log->setSearch($search);
                    $log->setSearchFrom($searchFrom);
                    $log->setContacted($contacted);
                    $log->setLiked($liked);

                    $em = $this->doctrine->getManager();
                    $em->persist($log);
                    $em->flush();
                    $conn->commit();

                    return $log;
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