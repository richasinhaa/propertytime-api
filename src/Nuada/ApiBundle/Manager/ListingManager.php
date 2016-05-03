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
    protected $photoManager;

    

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager,
                                PhotoManager $photoManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
        $this->photoManager = $photoManager;
    }

    public function load(
            $id = null,
            $limit = null,
            $offset = null,
            $withDeleted = false,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $bed = null,
            $minPrice = null,
            $maxPrice = null,
            $minArea = null,
            $maxArea = null,
            $furnishing = null,
            $agentId = null,
            $sortOn = null,
            $reverse = null,
            $withAgencies=true,
            $withPhotos=true)
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
            $bed,
            $minPrice,
            $maxPrice,
            $minArea,
            $maxArea,
            $furnishing,
            $agentId,
            $sortOn,
            $reverse);


        if (!is_null($properties)) {
            //with agency and with photo
            if ($withAgencies and $withPhotos) {
                if (is_array($properties)) {
                    foreach ($properties as $property) {
                        $agencyId = $property->getAgencyId();
                        if (!is_null($agencyId)) {
                            $agency = $this->agencyManager->load($agencyId);
                            $property->setAgency($agency);
                        }
                        $listingId = $property->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            $listingId
                        );
                        $property->setPhotos($photos);
                    }
                } else {
                    $agencyId = $properties->getAgencyId();
                    if (!is_null($agencyId)) {
                        $agency = $this->agencyManager->load($agencyId);
                        $properties->setAgency($agency);
                    }
                    $listingId = $properties->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        $listingId
                    );
                    $properties->setPhotos($photos);

                }
            } else if ($withAgencies) {
                if (is_array($properties)) {
                    foreach ($properties as $property) {
                        $agencyId = $property->getAgencyId();
                        if (!is_null($agencyId)) {
                            $agency = $this->agencyManager->load($agencyId);
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

            } else if  ($withPhotos) {
                if (is_array($properties)) {
                    foreach ($properties as $property) {
                        $listingId = $property->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            $listingId
                        );
                        $property->setPhotos($photos);
                    }
                } else {
                    $listingId = $properties->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        $listingId
                    );
                    $properties->setPhotos($photos);

                }
            }

        }

        return $properties;

    }

    public function getCount(
            $id = null,
            $withDeleted = false,
            $search = null,
            $city = null,
            $community = null,
            $category = null,
            $subcategory = null,
            $type = null,
            $agencyId = null,
            $bed = null,
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
            $bed,
            $minPrice,
            $maxPrice,
            $minArea,
            $maxArea,
            $furnishing,
            $agentId);

        return intval($count);

    }

}