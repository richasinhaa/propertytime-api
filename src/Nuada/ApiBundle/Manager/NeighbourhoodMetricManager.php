<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class NeighbourhoodMetricManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 20;
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
            $neighbourhoodId = null,
            $neighbourhoodName = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:NeighbourhoodMetric');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $metrics = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $neighbourhoodId,
            $neighbourhoodName);

        return $metrics;

    }

}