<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Contact Agency Controller
 *
 * @Route("/contactagencies")
 */
class ContactAgenciesController extends Controller
{
    /**
     * Contact agency
     *
     * @Method({"POST"})
     *
     *
     * @return array
     */
    public function postContactagenciesAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $agencyManager = $this->get('nuada_api.contact_agency_manager');
        try {
            $result = $agencyManager->contact($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        return View::create(array('message' => $result), Codes::HTTP_OK);
    }

    /**
     * Get contact agencies
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getContactagenciesAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $name = $request->query->get('name', null);
        $phone = $request->query->get('phone', null);
        $email = $request->query->get('email', null);
        $customerType = $request->query->get('customer_type', null);
        $agencyId = $request->query->get('agency_id', null);

        $contactAgencyManager = $this->get('nuada_api.contact_agency_manager');
        $contactAgencies = $contactAgencyManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $phone,
            $email,
            $customerType,
            $agencyId);

        if (null === $contactAgencies) {
            $contactAgencies = array();
        }
        
        return View::create(array('contacts' => $contactAgencies), Codes::HTTP_OK);
    }
}
