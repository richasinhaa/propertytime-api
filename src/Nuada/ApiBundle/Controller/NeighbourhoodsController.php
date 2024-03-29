<?php

namespace Nuada\ApiBundle\Controller;

use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Neighbourhoods Controller
 *
 * @Route("/neighbourhoods")
 */
class NeighbourhoodsController extends Controller
{

    /**
     * Get neighbourhoods
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getNeighbourhoodsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $name = $request->query->get('name', null);
        $withPhotos = strtolower($request->get('with_photos', 'true')) == 'true';
        $withAgencies = strtolower($request->get('with_agency', 'false')) == 'true';

        $neighbourhoodManager = $this->get('nuada_api.neighbourhood_manager');
        try {
            $neighbourhood = $neighbourhoodManager->load(
                $id,
                $name,
                $withDeleted,
                $offset,
                $limit,
                $withPhotos,
                $withAgencies
                );

            $neighbourhoodCount = $neighbourhoodManager->getCount(
                $id,
                $name,
                $withDeleted);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (null === $neighbourhood) {
            $neighbourhood = array();
        }

        return View::create(array('neighbourhoods' => $neighbourhood, 'count' => $neighbourhoodCount), Codes::HTTP_OK);
    }

    /**
     * Get neighbourhoods
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getNeighbourhoodsTopAction()
    {
        $request = $this->get('request');
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $count = $request->query->get('count', null);
        $withPhotos = strtolower($request->get('with_photos', 'true')) == 'true';

        $neighbourhoodManager = $this->get('nuada_api.neighbourhood_manager');
        try {
            $neighbourhood = $neighbourhoodManager->loadTop(
                $count,
                $withDeleted,
                $withPhotos
            );

        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (null === $neighbourhood) {
            $neighbourhood = array();
        }

        return View::create(array('neighbourhoods' => $neighbourhood), Codes::HTTP_OK);
    }
}
