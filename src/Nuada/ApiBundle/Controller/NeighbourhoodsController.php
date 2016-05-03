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

        $neighbourhoodManager = $this->get('nuada_api.neighbourhood_manager');
        try {
            $neighbourhood = $neighbourhoodManager->load(
                $id,
                $name,
                $withDeleted,
                $offset,
                $limit
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

        return View::create(array('photos' => $neighbourhood, 'count' => $neighbourhoodCount), Codes::HTTP_OK);
    }
}
