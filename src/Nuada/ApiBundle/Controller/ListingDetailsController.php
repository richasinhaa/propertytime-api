<?php

namespace Nuada\ApiBundle\Controller;

use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * ListingDetails Controller
 *
 * @Route("/listingdetails")
 */
class ListingDetailsController extends Controller
{

    /**
     * Get listing details
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingdetailsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $type = $request->query->get('type', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';

        $detailManager = $this->get('nuada_api.listing_detail_manager');
        try {
            $details = $detailManager->load(
                $id,
                $type,
                $withDeleted);

        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (null === $details) {
            $details = array();
        }

        return View::create(array('listing_details' => $details), Codes::HTTP_OK);
    }
}
