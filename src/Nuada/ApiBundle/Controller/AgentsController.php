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
            $agents = array();
        }
        
        return View::create(array('agents' => $agents, 'count' => $agentCount), Codes::HTTP_OK);
    }

    /**
     * Add new Agent
     *
     * @Method({"POST"})
     *
     *
     * @return array
     */
    public function postAgentsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $agentManager = $this->get('nuada_api.agent_manager');
        try {
            $agent = $agentManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($agent)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'agent' => $agent), Codes::HTTP_OK);
    }


    /**
     * Patch Agent
     *
     * @Method({"PATCH"})
     *
     * @return array
     */
    public function patchAgentsAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $agentManager = $this->get('nuada_api.agent_manager');
        try {
            $agent = $agentManager->load($id);

            if (is_null($agent)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedAgent= $agentManager->update($agent, $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedAgent)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'agent' => $updatedAgent), Codes::HTTP_OK);
    }

    /**
     * Delete agents
     *
     * @Method({"DELETE"})
     *
     * @return array
     */
    public function deleteAgentsAction($id) {
        $agentManager = $this->get('nuada_api.agent_manager');
        try {
            $agent = $agentManager->load($id);

            if (is_null($agent)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $agentManager->delete($agent);
            return View::create(array('message' => $response), Codes::HTTP_OK);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
