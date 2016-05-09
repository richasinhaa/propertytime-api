<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Login Controller
 *
 * @Route("/logout")
 */
class LogoutController extends Controller
{

    /**
     * Get agents
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getLogoutAction()
    {
    	        
        return View::create(array('result' => 'success', 'redirect' => '/#/home'), Codes::HTTP_OK);
    }
}
