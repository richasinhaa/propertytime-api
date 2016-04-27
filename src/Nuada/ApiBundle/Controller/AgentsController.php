<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Agents Controller
 *
 * @Route("/agents")
 */
class AgentsController extends Controller
{

    /**
     * Get agents
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getAgentsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $name = $request->query->get('name', null);
        $userId = $request->query->get('user_id', null);
        $agencyId = $request->query->get('agency_id', null);
        $sortOn = $request->query->get('sort_on', null);
        $reverse = $request->query->get('reverse', false);

        $agentManager = $this->get('nuada_api.agent_manager');
        $agents = $agentManager->load(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $agencyId,
            $sortOn,
            $reverse);

        $agentCount = $agentManager->getCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $agencyId);

        if (null === $agents) {
            return View::create(null, Codes::HTTP_NOT_FOUND);
        } else {
            return View::create(array('agents' => $agents, 'count' => $agentCount), Codes::HTTP_OK);
        }
    }
}
