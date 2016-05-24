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

        $id          = !empty($requestParams['id']) ? $requestParams['id'] : null;
        $limit       = !empty($requestParams['limit']) ? $requestParams['limit'] : $limit;
        $offset      = !empty($requestParams['offset']) ? $requestParams['offset'] : $offset;
        $search      = !empty($requestParams['search']) ? $requestParams['search'] : null;
        $city        = !empty($requestParams['city']) ? $requestParams['city'] : null;
        $community   = !empty($requestParams['community']) ? $requestParams['community'] : null;
        $category    = !empty($requestParams['category']) ? $requestParams['category'] : null;
        $subcategory = !empty($requestParams['sub_category']) ? $requestParams['sub_category'] : null;
        $type        = !empty($requestParams['type']) ? $requestParams['type'] : null;
        $agencyId    = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
        $bed         = !empty($requestParams['bedroom']) ? $requestParams['bedroom'] : null;
        $minPrice    = !empty($requestParams['min_price']) ? $requestParams['min_price'] : null;
        $maxPrice    = !empty($requestParams['max_price']) ? $requestParams['max_price'] : null;
        $minArea     = !empty($requestParams['min_area']) ? $requestParams['min_area'] : null;
        $maxArea     = !empty($requestParams['max_area']) ? $requestParams['max_area'] : null;
        $furnishing  = !empty($requestParams['furnishing']) ? $requestParams['furnishing'] : null;
        $agentId     = !empty($requestParams['agent_id']) ? $requestParams['agent_id'] : null;
        $sortOn      = !empty($requestParams['sort_on']) ? $requestParams['sort_on'] : null;

        if (array_key_exists('with_agencies', $requestParams) && $requestParams['with_agencies'] === false) {
            $withAgencies = false;
        } else {
            $withAgencies = true;
        }

        if (array_key_exists('with_photos', $requestParams) && $requestParams['with_photos'] === true) {
            $withPhotos = true;
        } else {
            $withPhotos = false;
        }

        if (array_key_exists('reverse', $requestParams) && $requestParams['reverse'] === true) {
            $reverse = true;
        } else {
            $reverse = false;
        }

        if (array_key_exists('with_deleted', $requestParams) && $requestParams['with_deleted'] === true) {
            $withDeleted = true;
        } else {
            $withDeleted = false;
        }
        
        if ($bed) {
            $bed = explode(',', $bed);
        }
        if ($type) {
            $type = explode(',', $type);
        }
        
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
            $bed,
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
            $bed,
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

    /**
     * Get sold listings count
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingsSoldcountAction() {
        $request = $this->get('request');
        $agencyId = $request->query->get('agency_id', null);

        $listingManager = $this->get('nuada_api.listing_manager');
        $listingCount = $listingManager->fetchSoldCount($agencyId);

        return View::create(array('count' => $listingCount), Codes::HTTP_OK);

    }
}
