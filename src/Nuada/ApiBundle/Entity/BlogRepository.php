<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM
 */
class BlogRepository extends EntityRepository
{
    /**
     * Retrieve All
     *
     * @param integer    $id           - Id
     * @param integer    $limit        - Limit
     * @param integer    $offset       - Offset
     * @param string     $name         - Name
     * @param string     $blogUrl      - BlogUrl
     * @param \DateTime  $from         - From date
     * @param \DateTime  $to           - Till date
     * @param boolean    $all          - All
     *
     * @return array
     */
    public function retrieveAll(
        $id=null,
        $limit=null,
        $offset=null,
        $name=null,
        $type=null,
        $blogUrl=null,
        $from=null,
        $to=null,
        $all=false)
    {
        $qb = $this->createQueryBuilder('e');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!$all) {
            $qb = $qb->andWhere('e.visible = true');
        }

        if (!is_null($name)) {
            $qb = $qb->andWhere('e.name = :name')
                ->setParameter('name', $name);
        }

        if (!is_null($type)) {
            $qb = $qb->andWhere('e.type = :type')
                ->setParameter('type', $type);
        }

        if (!is_null($blogUrl)) {
            $qb = $qb->andWhere('e.blogUrl = :blogUrl')
                ->setParameter('blogUrl', $blogUrl);
        }

        if (!is_null($from)) {
            $qb = $qb->andWhere('e.createdAt >= :from')
                ->setParameter('from', $from);
        }

        if (!is_null($to)) {
            $qb = $qb->andWhere('e.createdAt <= :to')
                ->setParameter('to', $to);
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
     * @param integer   $id           - Id
     * @param string    $name         - Name
     * @param string    $blogUrl      - BlogUrl
     * @param \DateTime $from         - From date
     * @param \DateTime $to           - To date
     * @param boolean   $all          - All
     *
     * @return array
     */
    public function fetchCount(
        $id=null,
        $name=null,
        $type=null,
        $blogUrl=null,
        $from=null,
        $to=null,
        $all=false)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('count(e)');

        if (!is_null($id)) {
            $qb = $qb->andWhere('e.id = :id')
                ->setParameter('id', $id);
        }

        if (!$all) {
            $qb = $qb->andWhere('e.visible = true');
        }

        if (!is_null($name)) {
            $qb = $qb->andWhere('e.name = :name')
                ->setParameter('name', $name);
        }

        if (!is_null($type)) {
            $qb = $qb->andWhere('e.type = :type')
                ->setParameter('type', $type);
        }

        if (!is_null($blogUrl)) {
            $qb = $qb->andWhere('e.blogUrl = :blogUrl')
                ->setParameter('blogUrl', $blogUrl);
        }

        if (!is_null($from)) {
            $qb = $qb->andWhere('e.createdAt >= :from')
                ->setParameter('from', $from);
        }

        if (!is_null($to)) {
            $qb = $qb->andWhere('e.createdAt <= :to')
                ->setParameter('to', $to);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
