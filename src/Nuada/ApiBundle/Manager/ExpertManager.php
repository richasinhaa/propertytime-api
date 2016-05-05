<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;

class ExpertManager
{
    protected $doctrine;
    protected $securityContext;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load($id=null,
                         $limit=null,
                         $offset=null,
                         $name=null,
                         $city=null,
                         $country=null,
                         $expertise=null,
                         $email=null,
                         $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Expert');
        $experts = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $name,
            $city,
            $country,
            $expertise,
            $email,
            $withDeleted
        );

        return $experts;

    }

    public function getCount(
        $id=null,
        $name=null,
        $city=null,
        $country=null,
        $expertise=null,
        $email=null,
        $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Expert');

        $count = $er->fetchCount(
            $id,
            $name,
            $city,
            $country,
            $expertise,
            $email,
            $withDeleted);

        return intval($count);

    }

}