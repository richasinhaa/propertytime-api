<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * UserAgencies Controller
 *
 * @Route("/useragencies")
 */
class UserAgenciesController extends Controller
{

    /**
     * Get user agencies
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getUseragenciesAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $userId = $request->query->get('user_id', null);
        $agencyId = $request->query->get('agency_id', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';

        $userAgencyManager = $this->get('nuada_api.user_agency_manager');
        $userAgencies = $userAgencyManager->load(
            $id,
            $limit,
            $offset,
            $userId,
            $agencyId,
            $withDeleted
        );

        $userAgenciesCount = $userAgencyManager->getCount(
            $id,
            $userId,
            $agencyId,
            $withDeleted);

        if (null === $userAgencies) {
            $userAgencies = array();
        }

        return View::create(array('user-agencies' => $userAgencies, 'count' => $userAgenciesCount), Codes::HTTP_OK);
    }

    /**
     * Post user agencies
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postUseragenciesAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $userAgencyManager = $this->get('nuada_api.user_agency_manager');
        try {
            $userAgency = $userAgencyManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($userAgency)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'user-agency' => $userAgency), Codes::HTTP_OK);
    }
}