<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\Rest\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Locations Controller
 *
 * @Route("/locations")
 */
class LocationsController extends Controller
{

    /**
     * Get locations
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getLocationsAction()
    {
        $request = $this->get('request');
        $search = $request->query->get('search', null);

        $locationManager = $this->get('nuada_api.location_manager');
        $locations = $locationManager->load($search);
        
        if (null === $locations) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('locations' => $locations), Codes::HTTP_OK);
        }
    }
}
