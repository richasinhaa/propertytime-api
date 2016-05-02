<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Summary Controller
 *
 * @Route("/summary")
 */
class SummaryController extends Controller
{

    /**
     * Get summary
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getSummaryAction()
    {
        $request = $this->get('request');

        $summaryManager = $this->get('nuada_api.summary_manager');
        $summary = $summaryManager->load();

        if (null === $summary) {
            $summary = array();
        }
        
        return View::create(array('summary' => $summary), Codes::HTTP_OK);
    }
}
