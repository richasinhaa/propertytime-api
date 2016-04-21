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

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/listings')) {
                // get_listings
                if (preg_match('#^/api/listings(?:\\.(?P<_format>json|pdf|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_listings;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_listings')), array (  '_controller' => 'Nuada\\ApiBundle\\Controller\\ListingsController::getListingsAction',  '_format' => 'json',));
                }
                not_get_listings:

                // post_listings
                if (preg_match('#^/api/listings(?:\\.(?P<_format>json|pdf|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_post_listings;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_listings')), array (  '_controller' => 'Nuada\\ApiBundle\\Controller\\ListingsController::postListingsAction',  '_format' => 'json',));
                }
                not_post_listings:

            }

            // get_agencies
            if (0 === strpos($pathinfo, '/api/agencies') && preg_match('#^/api/agencies(?:\\.(?P<_format>json|pdf|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_agencies;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_agencies')), array (  '_controller' => 'Nuada\\ApiBundle\\Controller\\AgenciesController::getAgenciesAction',  '_format' => 'json',));
            }
            not_get_agencies:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
