<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AdvertisementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertisementRepository extends EntityRepository
{
	 /**
     * Retrieve All
     *
     * @param integer    $id           - Id
     * @param integer    $limit        - Limit
     * @param integer    $offset       - Offset
     * @param string     $path         - Path
     * @param string     $redirectTo   - Redirect to
     * @param string     $path         - Path
     *
     * @return array
     */
    public function retrieveAll(
        	$id=null,
            $limit=null,
            $offset=null,
            $path=null,
            $redirectTo=null,
            $page=null,
            $withDeleted=false)
    {
        $qb = $this->createQueryBuilder('e');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!$withDeleted) {
            $qb = $qb->andWhere('e.deleted = false');
        }

        if (!is_null($path)) {
            $qb = $qb->andWhere('e.path = :path')
                ->setParameter('path', $path);
        }

        if (!is_null($redirectTo)) {
            $qb = $qb->andWhere('e.redirectTo = :redirectTo')
                ->setParameter('redirectTo', $redirectTo);
        }

        if (!is_null($page)) {
            $qb = $qb->andWhere('e.page = :page')
                ->setParameter('page', $page);
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
     * Retrieve All
     *
     * @param integer    $id           - Id
     * @param integer    $path         - Path
     * @param integer    $redirectTo   - Redirect to
     * @param string     $page         - Page
     * @param boolean    $withDeleted  - With Deleted
     *
     * @return array
     */
    public function fetchCount(
        	$id=null,
            $path=null,
            $redirectTo=null,
            $page=null,
            $withDeleted=false)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('count(e)');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!$withDeleted) {
            $qb = $qb->andWhere('e.deleted = false');
        }

        if (!is_null($path)) {
            $qb = $qb->andWhere('e.path = :path')
                ->setParameter('path', $path);
        }

        if (!is_null($redirectTo)) {
            $qb = $qb->andWhere('e.redirectTo = :redirectTo')
                ->setParameter('redirectTo', $redirectTo);
        }

        if (!is_null($page)) {
            $qb = $qb->andWhere('e.page = :page')
                ->setParameter('page', $page);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
