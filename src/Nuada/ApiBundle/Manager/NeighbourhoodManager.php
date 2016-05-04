<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;

class NeighbourhoodManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load(
        $id=null,
        $name=null,
        $withDeleted=false,
        $offset=null,
        $limit=null
        )
    {
        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Neighbourhood');
        $neighbourhood = $er->retrieveAll(
            $id,
            $name,
            $withDeleted,
            $offset,
            $limit
        );

        return $neighbourhood;

    }

    public function getCount(
        $id=null,
        $name=null,
        $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Neighbourhood');

        $count = $er->fetchCount(
            $id,
            $name,
            $withDeleted);

        return intval($count);

    }

    public function loadTop(
        $count=null,
        $withDeleted=false
        )
    {
        if (is_null($count)) {
            throw new BadAttributeException('count cant be null in the request');
        }

        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Neighbourhood');
        $neighbourhood = $er->retrieveTop(
            $count,
            $withDeleted
        );

        return $neighbourhood;

    }


}