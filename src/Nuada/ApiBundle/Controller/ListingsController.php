<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\Rest\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Listings Controller
 *
 * @Route("/listings")
 */
class ListingsController extends Controller
{
    /**
     * Get listings
     *
     * @return array
     */
    public function getListingsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';

        $listingManager = $this->get('nuada_api.listing_manager');
        $properties = $listingManager->loadAll(
            $id,
            $limit,
            $offset,
            $withDeleted);

        if (null === $properties) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('properties' => $properties), Codes::HTTP_OK);
        }
    }

}
