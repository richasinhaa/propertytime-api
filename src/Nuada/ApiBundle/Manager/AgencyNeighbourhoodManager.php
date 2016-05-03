<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\Summary;

class AgencyNeighbourhoodManager
{
    protected $doctrine;
    protected $securityContext;
    protected $agencyManager;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load(
        $id=null,
        $agencyId=null,
        $neighbourhoodId=null,
        $withDeleted=false,
        $withAgency=false
        )
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:AgencyNeighbourhood');
        $mapping = $er->retrieveAll(
            $id,
            $agencyId,
            $neighbourhoodId,
            $withDeleted
        );

        return $mapping;

    }

}