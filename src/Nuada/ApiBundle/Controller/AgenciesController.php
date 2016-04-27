<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Agencies Controller
 *
 * @Route("/agencies")
 */
class AgenciesController extends Controller
{

    /**
     * Get agencies
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getAgenciesAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $name = $request->query->get('name', null);
        $userId = $request->query->get('user_id', null);
        $userName = $request->query->get('user_name', null);
        $sortOn = $request->query->get('sort_on', null);
        $reverse = $request->query->get('reverse', false);

        $agencyManager = $this->get('nuada_api.agency_manager');
        $agencies = $agencyManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $userName,
            $sortOn,
            $reverse);

        $agencyCount = $agencyManager->getCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $userName);

        if (null === $agencies) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('agencies' => $agencies, 'count' => $agencyCount), Codes::HTTP_OK);
        }
    }
}
