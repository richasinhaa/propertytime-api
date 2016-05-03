<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Listings Controller
 *
 * @Route("/listings")
 */
class ListingsController extends Controller
{

    /**
     * fetch listings
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postListingsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $limit = 25;
        $offset = 0;

        $id          = $requestParams['id'] ? $requestParams['id'] : null;
        $limit       = $requestParams['limit'] ? $requestParams['limit'] : $limit;
        $offset      = $requestParams['offset'] ? $requestParams['offset'] : $offset;
        $withDeleted = $requestParams['with_deleted'] ? $requestParams['with_deleted'] : false;
        $search      = $requestParams['search'] ? $requestParams['search'] : null;
        $city        = $requestParams['city'] ? $requestParams['city'] : null;
        $community   = $requestParams['community'] ? $requestParams['community'] : null;
        $category    = $requestParams['category'] ? $requestParams['category'] : null;
        $subcategory = $requestParams['sub_category'] ? $requestParams['sub_category'] : null;
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
        $withAgencies= $requestParams['with_agencies'] ? $requestParams['with_agencies'] : true;
        $withPhotos  = $requestParams['with_photos'] ? $requestParams['with_photos'] : true;
        

        $listingManager = $this->get('nuada_api.listing_manager');
        $properties = $listingManager->load(
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
            $reverse,
            $withAgencies,
            $withPhotos);

        $propertyCount = $listingManager->getCount(
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
        
        if (null === $properties) {
            $properties = array();
        }
        
        return View::create(array('properties' => $properties, 'count' => $propertyCount), Codes::HTTP_OK);
    }
}
