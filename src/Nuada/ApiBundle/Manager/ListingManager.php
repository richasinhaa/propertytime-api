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
    protected $agencyManager;

    

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
    }

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $minBed = null,
            $maxBed = null,
            $minPrice = null,
            $maxPrice = null,
            $minArea = null,
            $maxArea = null,
            $furnishing = null,
            $agentId = null,
            $sortOn = null,
            $reverse = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');

        $properties = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $search,
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

        //with agency
        if (!is_null($properties)) {
            if (is_array($properties)) {
                foreach ($properties as $property) {
                    $agencyId = $property->getAgencyId();
                    if (!is_null($agencyId)) {
                        $agency = $this->agencyManager->load($id);
                        $property->setAgency($agency);
                    }
                }
            } else {
                $agencyId = $properties->getAgencyId();
                if (!is_null($agencyId)) {
                    $agency = $this->agencyManager->load($agencyId);
                    $properties->setAgency($agency);
                }

            }
        }

        return $properties;

    }

    public function getCount(
            $id = null,
            $withDeleted = null,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $minBed = null,
            $maxBed = null,
            $minPrice = null,
            $maxPrice = null,
            $minArea = null,
            $maxArea = null,
            $furnishing = null,
            $agentId = null) {

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Listing');
        
        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $search,
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
            $agentId);

        return $count;

    }

}