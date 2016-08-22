<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Nuada\ApiBundle\Manager\Mixpanel;

/**
 * Add Listings Controller
 *
 * @Route("/mixpanels")
 */
class MixpanelsController extends Controller
{
    /**
     * Post mixpanels
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postMixpanelsAction()
    {
      $requestParams = $this->getRequest()->request->all();
      $methods = $requestParams['methods'];
      $params = $requestParams['params'];
      
      if(is_array($methods) && is_array($params)) { 
        $api_secret = $this->container->getParameter('mixpanel_api_secret');
        $mp = new Mixpanel($api_secret);
        $data = $mp->request($methods, $params);
        
        return View::create(array('data' => $data), Codes::HTTP_OK);
      } else {
        return View::create(array('data' => null), Codes::HTTP_BAD_REQUEST);
      }
 
    }
}
