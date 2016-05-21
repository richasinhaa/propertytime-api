<?php

namespace Nuada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * Login Controller
 *
 */
class RedirectLoginController extends Controller
{
    public function redirectLoginAction(Request $request)
    {
    	$user = $this->getUser();
		$userId = $user->getId();
        return View::create(array('result' => 'success', 'user' => $user), Codes::HTTP_OK);
    }
}
