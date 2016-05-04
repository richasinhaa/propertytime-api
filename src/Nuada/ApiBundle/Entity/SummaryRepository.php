<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SummaryRepository
 *
 * This class was generated by the Doctrine ORM
 */
class SummaryRepository extends EntityRepository
{
	/**
     * Retrieve Summary
     *
     * @return array
     */
    public function retrieve()
    {
        $qb = $this->createQueryBuilder('e')
        		   ->orderBy('e.createdAt', 'desc')
        		   ->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getResult()[0];
    }
}