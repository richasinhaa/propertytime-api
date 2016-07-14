<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Logs Controller
 *
 * @Route("/logs")
 */
class LogsController extends Controller
{

    /**
     * Get logs
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getLogsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $userId = $request->query->get('user_id', null);
        $listingId = $request->query->get('listing_id', null);
        $agencyId = $request->query->get('agency_id', null);
        $search = $request->query->get('search', null);
        $searchFrom = $request->query->get('search_from', null);
        $contacted = $request->query->get('contacted', null);
        $liked = $request->query->get('liked', null);
        $ip = $request->query->get('ip', null);

        $logManager = $this->get('nuada_api.log_manager');
        $logs = $logManager->load(
            $id,
            $limit,
            $offset,
            $userId,
            $listingId,
            $agencyId,
            $search,
            $searchFrom,
            $contacted,
            $liked,
            $ip
        );

        $logCount = $logManager->getCount(
            $id,
            $userId,
            $listingId,
            $agencyId,
            $search,
            $searchFrom,
            $contacted,
            $liked,
            $ip);

        if (null === $logs) {
            $logs = array();
        }

        return View::create(array('logs' => $logs, 'count' => $logCount), Codes::HTTP_OK);
    }

    /**
     * Post logs
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postLogsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $logManager = $this->get('nuada_api.log_manager');
        try {
            $log = $logManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($log)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'log' => $log), Codes::HTTP_OK);
    }

    public function getLogsCountAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $userId = $request->query->get('user_id', null);
        $listingId = $request->query->get('listing_id', null);
        $agencyId = $request->query->get('agency_id', null);
        $search = $request->query->get('search', null);
        $searchFrom = $request->query->get('search_from', null);
        $contacted = $request->query->get('contacted', null);
        $liked = $request->query->get('liked', null);
        $ip = $request->query->get('ip', null);

        $logManager = $this->get('nuada_api.log_manager');

        $logCount = $logManager->getCount(
            $id,
            $userId,
            $listingId,
            $agencyId,
            $search,
            $searchFrom,
            $contacted,
            $liked,
            $ip);

        if (null === $logs) {
            $logs = array();
        }

        return View::create(array('count' => $logCount), Codes::HTTP_OK);
    }
}
