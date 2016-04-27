<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class AgencyManager
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

    public function load($id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $name = null,
            $userId = null,
            $userName = null,
            $sortOn = null,
            $reverse = false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $agencies = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $userName,
            $sortOn,
            $reverse);

        return $agencies;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $name = null,
                         $userId = null,
                         $userName = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $userName);

        return $count;

    }

}