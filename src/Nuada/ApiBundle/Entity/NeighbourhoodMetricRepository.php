<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NeighbourhoodMetricRepository
 *
 * This class was generated by the Doctrine ORM
 */
class NeighbourhoodMetricRepository extends EntityRepository
{
	/**
     * Retrieve All
     *
     * @param integer $id                - Listing Id
     * @param integer $limit             - Limit
     * @param integer $offset            - Offset
     * @param boolean $withDeleted       - With deleted metric
     * @param string  $neighbourhoodId   - Neighbourhood id
     * @param integer $neighbourhoodName - Neighbourhood name
     *
     * @return array
     */
    public function retrieveAll(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = false,
            $neighbourhoodId=null,
            $neighbourhoodName = null)
    {
        if (!is_null($id)) {
            return $this->find($id);
        }

        $qb = $this->createQueryBuilder('e');

        if (!$withDeleted) {
            $qb = $qb->andWhere('e.deleted = false');
        }

        if (!is_null($neighbourhoodId)) {
            $qb = $qb->andWhere('e.neighbourhoodId = :neighbourhoodId')
                     ->setParameter('neighbourhoodId', $neighbourhoodId);
        }
        
        if (!is_null($neighbourhoodName)) {
            $qb = $qb->andWhere('e.neighbourhoodName = :neighbourhoodName')
                     ->setParameter('neighbourhoodName', $neighbourhoodName);
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
}
