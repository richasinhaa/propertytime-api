<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Add Listings Controller
 *
 * @Route("/addlistings")
 */
class AddlistingsController extends Controller
{
/**
     * Add new Listing
     *
     * @Method({"POST"})
     *
     *
     * @return array
     */
    public function postAddlistingsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $listingManager = $this->get('nuada_api.listing_manager');
        try {
            $listing = $listingManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($listing)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'listing' => $listing), Codes::HTTP_OK);
    }
}
