<?php

namespace Nuada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Users Controller
 *
 * @Route("/users")
 */
class UsersController extends Controller
{

    /**
     * Get user
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getUsersAction()
    {
        $request = $this->get('request');
        $emailId = $request->query->get('email', null);

        $userManager = $this->get('nuada_api.user_manager');
        $user = $userManager->load(
            $emailId);

        if (null === $user) {
            return View::create(array('user' => array()), Codes::HTTP_NOT_FOUND);
        }

        return View::create(array('user' => $user), Codes::HTTP_OK);
    }

    /**
     * Get user
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function patchUsersAction()
    {
        $request = $this->getRequest()->request->all();

        $userManager = $this->get('nuada_api.user_manager');

        $user = $userManager->updateUserType($request);

        if (is_null($user)) {
            $message = 'failed';
            return View::create(array('message' => $message, 'user' => $user), Codes::HTTP_BAD_REQUEST);
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'user' => $user), Codes::HTTP_OK);
    }
}
