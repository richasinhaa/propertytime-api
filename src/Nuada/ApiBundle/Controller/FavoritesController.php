<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Favorites Controller
 *
 * @Route("/favorites")
 */
class FavoritesController extends Controller
{

    /**
     * Get favorites
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getFavoritesAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $userId = $request->query->get('user_id', null);
        $listingId = $request->query->get('listing_id', null);
        $withDeleted = strtolower($request->get('with_deleted', 'false')) == 'true';
        $withListing = strtolower($request->get('with_listing', 'true')) == 'true';

        $favoriteManager = $this->get('nuada_api.favorite_manager');
        $favorites = $favoriteManager->load(
            $id,
            $limit,
            $offset,
            $userId,
            $listingId,
            $withDeleted,
            $withListing
        );

        $favoriteCount = $favoriteManager->getCount(
            $id,
            $userId,
            $listingId,
            $withDeleted);

        if (null === $favorites) {
            $favorites = array();
        }

        return View::create(array('favorites' => $favorites, 'count' => $favoriteCount), Codes::HTTP_OK);
    }

    /**
     * Post favorites
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postFavoritesAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $favoriteManager = $this->get('nuada_api.favorite_manager');
        try {
            $favorite = $favoriteManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($favorite)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'favorite' => $favorite), Codes::HTTP_OK);
    }

    /**
     * Patch favorites
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function patchFavoritesAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $favoriteManager = $this->get('nuada_api.favorite_manager');
        try {
            $favorite = $favoriteManager->load(
                $id,
                null,//$limit,
                null, //$offset,
                null, //$userId,
                null, //$listingId,
                null, //$withDeleted,
                false);

            if (is_null($favorite[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedfavorite = $favoriteManager->update($favorite[0], $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedfavorite)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'favorite' => $updatedfavorite), Codes::HTTP_OK);
    }

    public function deleteFavoritesAction($id) {
        $favoriteManager = $this->get('nuada_api.favorite_manager');
        try {
            $favorite = $favoriteManager->load(
                $id,
                null,//$limit,
                null, //$offset,
                null, //$userId,
                null, //$listingId,
                null, //$withDeleted,
                false);

            if (is_null($favorite[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $favoriteManager->delete($favorite[0]);
            return View::create(array('message' => $response), Codes::HTTP_NOT_FOUND);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
