<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class AgentManager
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

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $name = null,
            $userId = null,
            $agencyId = null,
            $sortOn = null,
            $reverse = false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $agents = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $agencyId,
            $sortOn,
            $reverse);

        return $agents;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $name = null,
                         $userId = null,
                         $agencyId = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agent');

        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $agencyId);

        return intval($count);

    }

}