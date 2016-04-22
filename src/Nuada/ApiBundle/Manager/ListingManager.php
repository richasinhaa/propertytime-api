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

    public function load($requestParams=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');

        $id          = $requestParams['id'] ? $requestParams['id'] : null;
        $limit       = $requestParams['limit'] ? $requestParams['limit'] : self::LIMIT;
        $offset      = $requestParams['offset'] ? $requestParams['offset'] : self::OFFSET;
        $withDeleted = $requestParams['with_deleted'] ? $requestParams['with_deleted'] : false;
        $city        = $requestParams['city'] ? $requestParams['city'] : null;
        $community   = $requestParams['community'] ? $requestParams['community'] : null;
        $category    = $requestParams['category'] ? $requestParams['category'] : null;
        $category    = $requestParams['sub_category'] ? $requestParams['sub_category'] : null;
        $type        = $requestParams['type'] ? $requestParams['type'] : null;
        $agencyId    = $requestParams['agency_id'] ? $requestParams['agency_id'] : null;
        $minBed      = $requestParams['min_bed'] ? $requestParams['min_bed'] : null;
        $maxBed      = $requestParams['max_bed'] ? $requestParams['max_bed'] : null;
        $minPrice    = $requestParams['min_price'] ? $requestParams['min_price'] : null;
        $maxPrice    = $requestParams['max_price'] ? $requestParams['max_price'] : null;
        $minArea     = $requestParams['min_area'] ? $requestParams['min_area'] : null;
        $maxArea     = $requestParams['max_area'] ? $requestParams['max_area'] : null;
        $furnishing  = $requestParams['furnishing'] ? $requestParams['furnishing'] : null;
        $agentId     = $requestParams['agent_id'] ? $requestParams['agent_id'] : null;
        $sortOn      = $requestParams['sort_on'] ? $requestParams['sort_on'] : null;
        $reverse     = $requestParams['reverse'] ? $requestParams['reverse'] : false;

        $properties = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $city,
            $community,
            $category,
            $subcategory,
            $type,
            $agencyId,
            $minBed,
            $maxBed,
            $minPrice,
            $maxPrice,
            $minArea,
            $maxArea,
            $furnishing,
            $agentId,
            $sortOn,
            $reverse);

        return $properties;

    }

}