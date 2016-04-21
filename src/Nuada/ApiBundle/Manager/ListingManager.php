<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\Listing;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class ListingManager
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

    public function loadAll($id = null, $limit = null, $offset = null, $withDeleted = false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $properties = $er->retrieveAll($id, $limit, $offset, $withDeleted);

        return $properties;

    }

}