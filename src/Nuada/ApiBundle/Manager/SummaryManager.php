<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\Summary;

class SummaryManager
{
    protected $doctrine;
    protected $securityContext;

    const LISTING_SUBCATEGORY_BUY  = 'Buy';
    const LISTING_SUBCATEGORY_RENT = 'Rent';

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load()
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Summary');
        $summary = $er->retrieve();

        return $summary;

    }

}