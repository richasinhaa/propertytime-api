<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class AgencyManager
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

    public function load($id = null,
            $limit = null,
            $offset = null,
            $withDeleted = null,
            $name = null,
            $userId = null,
            $userName = null,
            $sortOn = null,
            $reverse = false,
            $withPhotos=true)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $agencies = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $userId,
            $userName,
            $sortOn,
            $reverse);

        //with photos
        if (!is_null($agencies)) {
            if ($withPhotos) {
                if (is_array($agencies)) {
                    foreach ($agencies as $agency) {
                        $agencyId = $agency->getId();
                        $photos = $this->photoManager->load(
                            null, //$id
                            null, //$listingId
                            $agencyId
                        );
                        $agency->setPhotos($photos);
                    }
                } else {
                    $agencyId = $agencies->getId();
                    $photos = $this->photoManager->load(
                        null, //$id
                        null, //$listingId
                        $agencyId
                    );
                    $agencies->setPhotos($photos);

                }
            }
        }

        return $agencies;

    }

    public function getCount(
                         $id = null,
                         $withDeleted = false,
                         $name = null,
                         $userId = null,
                         $userName = null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Agency');

        $count = $er->fetchCount(
            $id,
            $withDeleted,
            $name,
            $userId,
            $userName);

        return intval($count);

    }

}