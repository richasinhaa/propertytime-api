<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * NeighbourhoodMetrics Controller
 *
 * @Route("/neighbourhoodmetrics")
 */
class NeighbourhoodMetricsController extends Controller
{

    /**
     * Get metrics
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getNeighbourhoodmetricsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $neighbourhoodId = $request->query->get('neighbourhood_id', null);
        $neighbourhoodName = $request->query->get('neighbourhood_name', null);

        $metricManager = $this->get('nuada_api.neighbourhood_metric_manager');
        $metrics = $metricManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $neighbourhoodId,
            $neighbourhoodName);

        if (null === $metrics) {
            $summary = array();
        }
        
        return View::create(array('neighbourhood_metrics' => $metrics), Codes::HTTP_OK);
    }
}
