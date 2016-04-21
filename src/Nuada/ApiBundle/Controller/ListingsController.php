<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\Rest\Util\Codes;
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
     * Get listing
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);

        $listingManager = $this->get('nuada_api.listing_manager');
        $property = $listingManager->load($id);

        if (null === $property) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('property' => $property), Codes::HTTP_OK);
        }
    }

    /**
     * post listings
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postListingsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $listingManager = $this->get('nuada_api.listing_manager');
        $properties = $listingManager->load(
            null, //$id
            $requestParams);

        if (null === $properties) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('properties' => $properties), Codes::HTTP_OK);
        }
    }
}
