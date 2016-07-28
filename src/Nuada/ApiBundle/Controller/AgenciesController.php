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
        $searchForLocation = $request->query->get('search_for_location', null);
        $rank = $request->query->get('rank', null);

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
            $withAgents,
            $searchForLocation,
            $rank);

        $agencyCount = $agencyManager->getCount(
            $id,
            $withDeleted,
            $search,
            $name,
            $userId,
            $userName,
            $searchForLocation,
            $rank);

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

    /**
     * Add new Agency
     *
     * @Method({"POST"})
     *
     *
     * @return array
     */
    public function postAgenciesAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $agencyManager = $this->get('nuada_api.agency_manager');
        try {
            $agency = $agencyManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($agency)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'agency' => $agency), Codes::HTTP_OK);
    }


    /**
     * Patch Agency
     *
     * @Method({"PATCH"})
     *
     * @return array
     */
    public function patchAgenciesAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $agencyManager = $this->get('nuada_api.agency_manager');
        try {
            $agency = $agencyManager->load($id);

            if (is_null($agency)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedAgency= $agencyManager->update($agency, $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedAgency)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'agency' => $updatedAgency), Codes::HTTP_OK);
    }

    /**
     * Delete agencies
     *
     * @Method({"DELETE"})
     *
     * @return array
     */
    public function deleteAgenciesAction($id) {
        $agencyManager = $this->get('nuada_api.agency_manager');
        try {
            $agency = $agencyManager->load($id);

            if (is_null($agency)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $agencyManager->delete($agency);
            return View::create(array('message' => $response), Codes::HTTP_OK);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
