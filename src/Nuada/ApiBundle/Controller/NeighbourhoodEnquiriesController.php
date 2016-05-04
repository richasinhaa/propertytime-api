<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Summary Controller
 *
 * @Route("/neighbourhoodenquiries")
 */
class NeighbourhoodEnquiriesController extends Controller
{

    /**
     * Get NeighbourhoodEnquiries
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postNeighbourhoodenquiriesAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $enquiryManager = $this->get('nuada_api.neighbourhood_enquiry_manager');
        try {
            $neighbourhoodEnquiry = $enquiryManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($neighbourhoodEnquiry)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'enquiry' => $neighbourhoodEnquiry), Codes::HTTP_OK);
    }
}
