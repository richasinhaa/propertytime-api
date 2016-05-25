<?php

namespace Nuada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * UpdateduserController
 *
 * @Route("/updateduser")
 */
class UpdateduserController extends Controller
{
    /**
     * Post updated users
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postUpdatedusersAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $updateUserManager = $this->get('nuada_api.update_user_manager');
        try {
            $updateUser = $updateUserManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updateUser)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'update' => $updateUser), Codes::HTTP_OK);
    }

    /**
     * Patch updated users
     *
     * @Method({"PATCH"})
     *
     * @return array
     */
    public function patchUpdatedusersAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $updateUserManager = $this->get('nuada_api.update_user_manager');
        try {
            $updatedUser = $updateUserManager->load($id);
            
        if (is_null($updatedUser)) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedUser = $updateUserManager->update($updatedUser, $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedUser)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'update' => $updatedUser), Codes::HTTP_OK);
    }
}
