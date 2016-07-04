<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Advertisements Controller
 *
 * @Route("/advertisements")
 */
class AdvertisementsController extends Controller
{

    /**
     * Get advertisements
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getAdvertisementsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $path = $request->query->get('path', null);
        $redirectTo = $request->query->get('redirect_to', null);
        $page = $request->query->get('page', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';

        $advertisementManager = $this->get('nuada_api.advertisement_manager');
        $advertisements = $advertisementManager->load(
            $id,
            $limit,
            $offset,
            $path,
            $redirectTo,
            $page,
            $withDeleted
        );

        $advertisementCount = $advertisementManager->getCount(
            $id,
            $path,
            $redirectTo,
            $page,
            $withDeleted);

        if (null === $advertisements) {
            $advertisements = array();
        }

        return View::create(array('advertisements' => $advertisements, 'count' => $advertisementCount), Codes::HTTP_OK);
    }

    /**
     * Post advertisements
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postAdvertisementsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $advertisementManager = $this->get('nuada_api.advertisement_manager');
        try {
            $advertisement = $advertisementManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($advertisement)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'advertisement' => $advertisement), Codes::HTTP_OK);
    }


    public function deleteAdvertisementsAction($id) {
        $advertisementManager = $this->get('nuada_api.advertisement_manager');
        try {
            $advertisement = $advertisementManager->load($id);

            if (is_null($advertisement[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $advertisementManager->delete($advertisement[0]);
            return View::create(array('message' => $response), Codes::HTTP_OK);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
