<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * LogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LogRepository extends EntityRepository
{
	/**
     * Retrieve All
     *
     * @return array
     */
    public function retrieveAll(
        	$id=null,
            $limit=null,
            $offset=null,
            $userId=null,
            $listingId=null,
            $agencyId=null,
            $search=null,
            $searchFrom=null,
            $contacted=null,
            $liked=null,
            $ip=null)
    {
        $qb = $this->createQueryBuilder('e');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!is_null($userId)) {
            $qb = $qb->andWhere('e.userId = :userId')
                ->setParameter('userId', $userId);
        }

        if (!is_null($listingId)) {
            $qb = $qb->andWhere('e.propertyId = :listingId')
                ->setParameter('listingId', $listingId);
        }

        if (!is_null($agencyId)) {
            $qb = $qb->andWhere('e.agencyId = :agencyId')
                ->setParameter('agencyId', $agencyId);
        }

        if (!is_null($search)) {
            $qb = $qb->andWhere('e.search = :search')
                ->setParameter('search', $search);
        }

        if (!is_null($searchFrom)) {
            $qb = $qb->andWhere('e.searchFrom = :searchFrom')
                ->setParameter('searchFrom', $searchFrom);
        }

        if (!is_null($contacted)) {
            $qb = $qb->andWhere('e.contacted = :contacted')
                ->setParameter('contacted', $contacted);
        }

        if (!is_null($liked)) {
            $qb = $qb->andWhere('e.liked = :liked')
                ->setParameter('liked', $liked);
        }

        if (!is_null($ip)) {
            $qb = $qb->andWhere('e.ip = :ip')
                ->setParameter('ip', $ip);
        }

        if ($offset) {
            $qb->setMaxResults($limit);
            $qb->setFirstResult($offset);
        }

        if ($limit && !$offset) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * fetch count
     *
     * @return array
     */
    public function fetchCount(
         	$id=null,
            $userId=null,
            $listingId=null,
            $agencyId=null,
            $search=null,
            $searchFrom=null,
            $contacted=null,
            $liked=null,
            $ip=null)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('count(e)');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!is_null($userId)) {
            $qb = $qb->andWhere('e.userId = :userId')
                ->setParameter('userId', $userId);
        }

        if (!is_null($listingId)) {
            $qb = $qb->andWhere('e.propertyId = :listingId')
                ->setParameter('listingId', $listingId);
        }

        if (!is_null($agencyId)) {
            $qb = $qb->andWhere('e.agencyId = :agencyId')
                ->setParameter('agencyId', $agencyId);
        }

        if (!is_null($search)) {
            $qb = $qb->andWhere('e.search = :search')
                ->setParameter('search', $search);
        }

        if (!is_null($searchFrom)) {
            $qb = $qb->andWhere('e.searchFrom = :searchFrom')
                ->setParameter('searchFrom', $searchFrom);
        }

        if (!is_null($contacted)) {
            $qb = $qb->andWhere('e.contacted = :contacted')
                ->setParameter('contacted', $contacted);
        }

        if (!is_null($liked)) {
            $qb = $qb->andWhere('e.liked = :liked')
                ->setParameter('liked', $liked);
        }

        if (!is_null($ip)) {
            $qb = $qb->andWhere('e.ip = :ip')
                ->setParameter('ip', $ip);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
