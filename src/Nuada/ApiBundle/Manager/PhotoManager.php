<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class PhotoManager
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
         $listingId=null,
         $agencyId=null,
         $sortOn=null,
         $reverse=false,
         $limit=null,
         $offset=null,
         $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Photo');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        if (!is_null($listingId) and !is_null($agencyId)) {
            throw new BadAttributeException('Request should not have both listing id and agency id');
        }
        
        $photos = $er->retrieveAll(
            $id,
            $listingId,
            $agencyId,
            $sortOn,
            $reverse,
            $limit,
            $offset,
            $withDeleted);

        return $photos;

    }

    public function getCount(
        $id=null,
        $listingId=null,
        $agencyId=null,
        $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Photo');

        $count = $er->fetchCount(
            $id,
            $listingId,
            $agencyId,
            $withDeleted);

        return intval($count);

    }

}