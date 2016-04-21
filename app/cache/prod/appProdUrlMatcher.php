<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // get_listings
        if (0 === strpos($pathinfo, '/api/listings') && preg_match('#^/api/listings(?:\\.(?P<_format>json|pdf|html))?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_listings;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_listings')), array (  '_controller' => 'Nuada\\ApiBundle\\Controller\\ListingsController::getListingsAction',  '_format' => 'json',));
        }
        not_get_listings:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
