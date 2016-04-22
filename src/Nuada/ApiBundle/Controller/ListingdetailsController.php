<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\Rest\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Listing details Controller
 *
 * @Route("/listingdetails")
 */
class ListingdetailsController extends Controller
{

    /**
     * Get agencies
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getListingdetailsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $listingId = $request->query->get('listing_id', null);
        $imageId = $request->query->get('image_id', null);

        $detailManager = $this->get('nuada_api.listing_detail_manager');
        $details = $detailManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $listingId,
            $imageId,
            $sortOn,
            $reverse);

        if (null === $details) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('listingdetails' => $details), Codes::HTTP_OK);
        }
    }
}
