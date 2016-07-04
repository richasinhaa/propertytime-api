<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Reviews Controller
 *
 * @Route("/reviews")
 */
class ReviewsController extends Controller
{

    /**
     * Get reviews
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getReviewsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $agencyId = $request->query->get('agency_id', null);
        $agentId = $request->query->get('agent_id', null);
        $agentName = $request->query->get('agent_name', null);
        $rating = $request->query->get('rating', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $withAgency = strtolower($request->get('with_agency', 'false')) == 'true';
        $withAgent = strtolower($request->get('with_agent', 'false')) == 'true';

        $reviewManager = $this->get('nuada_api.review_manager');
        $reviews = $reviewManager->load(
            $id,
            $limit,
            $offset,
            $agencyId,
            $agentId,
            $agentName,
            $rating,
            $withDeleted,
            $from,
            $to,
            $withAgency,
            $withAgent
        );

        $reviewCount = $reviewManager->getCount(
            $id,
            $agencyId,
            $agentId,
            $agentName,
            $rating,
            $withDeleted,
            $from,
            $to);

        if (null === $reviews) {
            $reviews = array();
        }

        return View::create(array('reviews' => $reviews, 'count' => $reviewCount), Codes::HTTP_OK);
    }

    /**
     * Post reviews
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postReviewsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $reviewManager = $this->get('nuada_api.review_manager');
        try {
            $review = $reviewManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($review)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'review' => $review), Codes::HTTP_OK);
    }


    public function deleteReviewsAction($id) {
        $reviewManager = $this->get('nuada_api.review_manager');
        try {
            $review = $reviewManager->load($id);

            if (is_null($review[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $reviewManager->delete($review[0]);
            return View::create(array('message' => $response), Codes::HTTP_OK);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
