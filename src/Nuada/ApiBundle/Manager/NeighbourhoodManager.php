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
    protected $photoManager;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                PhotoManager $photoManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->photoManager = $photoManager;
    }

    public function load(
        $id=null,
        $name=null,
        $withDeleted=false,
        $offset=null,
        $limit=null,
        $withPhotos=false
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


        //with photos
        if (!is_null($neighbourhood)) {
            if ($withPhotos) {
                if (is_array($neighbourhood)) {
                    foreach ($neighbourhood as $nbd) {
                        $nbdId = $nbd->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            null, //$listingId
                            null,//$agencyId
                            $nbdId
                        );
                        $nbd->setPhotos($photos);
                    }
                } else {
                    $nbdId = $neighbourhood->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        null, //$listingId
                        null, //$agencyId
                        $nbdId
                    );
                    $neighbourhood->setPhotos($photos);

                }
            }
        }

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
        $withDeleted=false,
        $withPhotos=false
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

        //with photos
        if (!is_null($neighbourhood)) {
            if ($withPhotos) {
                if (is_array($neighbourhood)) {
                    foreach ($neighbourhood as $nbd) {
                        $nbdId = $nbd->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            null, //$listingId
                            null,//$agencyId
                            $nbdId
                        );
                        $nbd->setPhotos($photos);
                    }
                } else {
                    $nbdId = $neighbourhood->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        null, //$listingId
                        null, //$agencyId
                        $nbdId
                    );
                    $neighbourhood->setPhotos($photos);

                }
            }
        }

        return $neighbourhood;

    }


}