<?php

namespace Nuada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * AuthenticateUsersController
 *
 * @Route("/authenticateusers")
 */
class AuthenticateUsersController extends Controller
{
    /**
     * POST users
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postAuthenticateusersAction()
    {
        $requestParams = $this->getRequest()->request->all();
        $email = $requestParams['email'] ? $requestParams['email'] : null;
        $password = $requestParams['password'] ? $requestParams['password'] : null;

        if(is_null($email) || is_null($password)) {
            return View::create(array('message' => 'Please verify all your inputs.'), Codes::HTTP_UNAUTHORIZED);
        }
        try {
            $user_manager = $this->get('fos_user.user_manager');
            $factory = $this->get('security.encoder_factory');

            $user = $user_manager->findUserByUsername($email);
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();

            if($encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
                return View::create(array('message' => 'Authenticated', 'email' => $user->getUsername(), 'name' => $user->getName(), 'user_id' => $user->getId()), Codes::HTTP_OK);
            } else {
                return View::create(array('message' => 'Username or Password not valid.'), Codes::HTTP_UNAUTHORIZED);
            }
        } catch(\Exception $e) {
            return View::create(array('message' => 'Username or Password not valid.'), Codes::HTTP_UNAUTHORIZED);
        }
    }
}