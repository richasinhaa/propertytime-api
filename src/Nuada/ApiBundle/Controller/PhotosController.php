<?php

namespace Nuada\ApiBundle\Controller;

use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Photos Controller
 *
 * @Route("/photos")
 */
class PhotosController extends Controller
{

    /**
     * Get photos
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getPhotosAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $listingId = $request->query->get('listing_id', null);
        $agencyId = $request->query->get('agency_id', null);
        $sortOn = $request->query->get('sort_on', null);
        $reverse = $request->query->get('reverse', false);

        $photoManager = $this->get('nuada_api.photo_manager');
        try {
            $photos = $photoManager->load(
                $id,
                $listingId,
                $agencyId,
                $sortOn,
                $reverse,
                $limit,
                $offset,
                $withDeleted);

            $photoCount = $photoManager->getCount(
                $id,
                $listingId,
                $agencyId,
                $withDeleted);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (null === $photos) {
            $photos = array();
        }
        
        return View::create(array('photos' => $photos, 'count' => $photoCount), Codes::HTTP_OK);
    }
}
