<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ExpertRepository
 *
 * This class was generated by the Doctrine ORM
 */
class ExpertRepository extends EntityRepository
{
    /**
     * Retrieve All
     *
     * @param integer $id           - Listing Id
     * @param integer $limit        - Limit
     * @param integer $offset       - Offset
     * @param string  $name         - Name
     * @param string  $city         - City
     * @param string  $country      - Country
     * @param string  $expertise    - Expertise
     * @param string  $email        - Email
     * @param boolean $withDeleted  - With deleted Experts
     *
     * @return array
     */
    public function retrieveAll(
        $id=null,
        $limit=null,
        $offset=null,
        $name=null,
        $city=null,
        $country=null,
        $expertise=null,
        $email=null,
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

        if (!is_null($name)) {
            $qb = $qb->andWhere('e.name = :name')
                ->setParameter('name', $name);
        }

        if (!is_null($city)) {
            $qb = $qb->andWhere('e.city = :city')
                ->setParameter('city', $city);
        }

        if (!is_null($country)) {
            $qb = $qb->andWhere('e.country = :country')
                ->setParameter('country', $country);
        }

        if (!is_null($expertise)) {
            $qb = $qb->andWhere('e.expertise = :expertise')
                ->setParameter('expertise', $expertise);
        }

        if (!is_null($email)) {
            $qb = $qb->andWhere('e.email = :email')
                ->setParameter('email', $email);
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
     * @param integer $id           - Listing Id
     * @param string  $name         - Name
     * @param string  $city         - City
     * @param string  $country      - Country
     * @param string  $expertise    - Expertise
     * @param string  $email        - Email
     * @param boolean $withDeleted  - With deleted Experts
     *
     * @return array
     */
    public function fetchCount(
        $id=null,
        $name=null,
        $city=null,
        $country=null,
        $expertise=null,
        $email=null,
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

        if (!is_null($name)) {
            $qb = $qb->andWhere('e.name = :name')
                ->setParameter('name', $name);
        }

        if (!is_null($city)) {
            $qb = $qb->andWhere('e.city = :city')
                ->setParameter('city', $city);
        }

        if (!is_null($country)) {
            $qb = $qb->andWhere('e.country = :country')
                ->setParameter('country', $country);
        }

        if (!is_null($expertise)) {
            $qb = $qb->andWhere('e.expertise = :expertise')
                ->setParameter('expertise', $expertise);
        }

        if (!is_null($email)) {
            $qb = $qb->andWhere('e.email = :email')
                ->setParameter('email', $email);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }
}
