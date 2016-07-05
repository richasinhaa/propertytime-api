<?php

namespace Nuada\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 */
class UserRepository extends EntityRepository
{
    /**
     * Retrieve
     *
     * @param string $email - Email Id
     *
     * @return array
     */
    public function retrieve($email=null)
    {
        $qb = $this->createQueryBuilder('e');

        if (!is_null($email)) {
            $qb = $qb->andWhere('e.email = :email')
                ->setParameter('email', $email);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
