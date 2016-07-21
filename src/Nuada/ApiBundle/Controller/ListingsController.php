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
        $frequency   = !empty($requestParams['frequency']) ? $requestParams['frequency'] : null;

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
            $bed = array_filter($bed);
        }
        if ($type) {
            $type = explode(',', $type);
            $type = array_filter($type);
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
            $withPhotos,
            $frequency);

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
            $agentId,
            null, //fromdate
            null, //todate
            $frequency);
        
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
    public function getListingsCountAction() {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $search = $request->query->get('search', null);
        $city = $request->query->get('city', null);
        $community = $request->query->get('community', null);
        $category = $request->query->get('category', null);
        $subcategory = $request->query->get('sub_category', null);
        $agencyId = $request->query->get('agency_id', null);
        $type = $request->query->get('type', null);
        $bed = $request->query->get('bedroom', null);
        $minPrice = $request->query->get('min_price', null);
        $maxPrice = $request->query->get('max_price', null);
        $minArea = $request->query->get('min_area', null);
        $maxArea = $request->query->get('max_area', null);
        $furnishing = $request->query->get('furnishing', null);
        $agentId = $request->query->get('agent_id', null);
        $fromDate = $request->query->get('from', null);
        $toDate = $request->query->get('to', null);
        $frequency = $request->query->get('frequency', null);

        if ($bed) {
            $bed = explode(',', $bed);
            $bed = array_filter($bed);
        }
        if ($type) {
            $type = explode(',', $type);
            $type = array_filter($type);
        }
        
        $listingManager = $this->get('nuada_api.listing_manager');
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
            $agentId,
            $fromDate,
            $toDate,
            $frequency);

        return View::create(array('count' => $propertyCount), Codes::HTTP_OK);

    }

    public function getListingsMiscelleneouscountAction() {
        $request = $this->get('request');
        $agencyId = $request->query->get('agency_id', null);
        $listingManager = $this->get('nuada_api.listing_manager');
        $unpublished = $listingManager->getUnpublishedCount($agencyId);
        $published = $listingManager->getPublishedCount($agencyId);
        $active = $listingManager->getActiveCount($agencyId);

        return View::create(array(
            'total_unpublished' => $unpublished,
            'total_published' => $published,
            'total_active' => $active
             ), Codes::HTTP_OK);
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

    /**
     * Patch listings
     *
     * @Method({"PATCH"})
     *
     * @return array
     */
    public function patchListingsAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $listingManager = $this->get('nuada_api.listing_manager');
        try {
            $listing = $listingManager->load($id);

            if (is_null($listing)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedListing= $listingManager->update($listing, $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedListing)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'listing' => $updatedListing), Codes::HTTP_OK);
    }

    /**
     * Delete listings
     *
     * @Method({"DELETE"})
     *
     * @return array
     */
    public function deleteListingsAction($id) {
        $listingManager = $this->get('nuada_api.listing_manager');
        try {
            $listing = $listingManager->load($id);

            if (is_null($listing)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $listingManager->delete($listing);
            return View::create(array('message' => $response), Codes::HTTP_OK);
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * Get yearly listings count
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingsCountforyearAction() {
        $request = $this->get('request');
        $agencyId = $request->query->get('agency_id', null);

        $listingManager = $this->get('nuada_api.listing_manager');
        $listingCount = $listingManager->fetchListingCountForAnYear($agencyId);

        return View::create(array('count' => $listingCount), Codes::HTTP_OK);
    }

    /**
     * Get all listing types
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingsTypesAction() {
        $request = $this->get('request');

        $listingManager = $this->get('nuada_api.listing_manager');
        $listingTypes = $listingManager->fetchAllListingTypes();

        return View::create(array('listing_types' => $listingTypes), Codes::HTTP_OK);
    }
}
