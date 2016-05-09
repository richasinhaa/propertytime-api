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
 * @Route("/login")
 */
class LoginController extends Controller
{

    /**
     * Get agents
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getLoginAction()
    {
    	        
        return View::create(array('result' => 'success', 'redirect' => '/#/profile'), Codes::HTTP_OK);
    }
}
