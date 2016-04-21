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
     * fetch listings
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
            $requestParams,
            $sortOn,
            $reverse);

        if (null === $properties) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('properties' => $properties), Codes::HTTP_OK);
        }
    }
}
