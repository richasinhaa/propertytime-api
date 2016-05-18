<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


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
        $withPhotos = strtolower($request->get('with_deleted', 'true')) == 'true';
        $withAgents = strtolower($request->get('with_agents', 'false')) == 'true';
        $search = $request->query->get('search', null);

        if ($search == '') {
            $search = null;
        }
        if ($name == '') {
            $name = null;
        }
        $agencyManager = $this->get('nuada_api.agency_manager');
        $agencies = $agencyManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $search,
            $name,
            $userId,
            $userName,
            $sortOn,
            $reverse,
            $withPhotos,
            $withAgents);

        $agencyCount = $agencyManager->getCount(
            $id,
            $withDeleted,
            $search,
            $name,
            $userId,
            $userName);

        if (null === $agencies) {
            $agencies = array();
        }
        
        return View::create(array('agencies' => $agencies, 'count' => $agencyCount), Codes::HTTP_OK);
    }


    /**
     * Get top listed agencies for a neighbourhood (data from bf_company, nl_neighbourhood and nl_agency_neighbourhood)
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getAgenciesTopAction()
    {
        $request = $this->get('request');
        $neighbourhood = $request->query->get('neighbourhood', null);
        $count = $request->query->get('count', null);

        $agencyManager = $this->get('nuada_api.agency_manager');
        try {
            $agencies = $agencyManager->loadForNeighbourhood(
                $neighbourhood,
                $count);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (null === $agencies) {
            $agencies = array();
        }

        return View::create(array('agencies' => $agencies), Codes::HTTP_OK);
    }

    /**
     * Connect to agency
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getAgenciesConnectAction()
    {
        $request = $this->get('request');
        $agencyId = $request->query->get('agency_id', null);
        $allowed = false;
        $phoneNumber = null;

        //if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            $agencyManager = $this->get('nuada_api.agency_manager');
            $contactDetails = $agencyManager->fetchContactDetails($agencyId);

            $allowed = true;
        //}

        return View::create(array('allowed' => $allowed,
            'contact_number' => $contactDetails['phone'],
            'email' => $contactDetails['email']), Codes::HTTP_OK);
    }
}
