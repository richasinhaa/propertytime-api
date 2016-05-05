<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Experts Controller
 *
 * @Route("/experts")
 */
class ExpertsController extends Controller
{

    /**
     * Get experts
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getExpertsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $name = $request->query->get('name', null);
        $city = $request->query->get('city', null);
        $country = $request->query->get('country', null);
        $expertise = $request->query->get('expertise', null);
        $email = $request->query->get('email', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';

        $expertManager = $this->get('nuada_api.expert_manager');
        $experts = $expertManager->load(
            $id,
            $limit,
            $offset,
            $name,
            $city,
            $country,
            $expertise,
            $email,
            $withDeleted
        );

        $expertCount = $expertManager->getCount(
            $id,
            $name,
            $city,
            $country,
            $expertise,
            $email,
            $withDeleted);

        if (null === $experts) {
            $experts = array();
        }

        return View::create(array('experts' => $experts, 'count' => $expertCount), Codes::HTTP_OK);
    }
}
