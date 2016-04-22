<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class ListingdetailManager
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
            $listingId = null,
            $imageId = null,
            $sortOn = null,
            $reverse = false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listingdetail');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $details = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $listingId,
            $imageId,
            $sortOn,
            $reverse);

        return $details;

    }

}