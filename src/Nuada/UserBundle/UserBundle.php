<?php

namespace Nuada\UserBundle;

use Nuada\UserBundle\DependencyInjection\NuadaUserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
	}
}
