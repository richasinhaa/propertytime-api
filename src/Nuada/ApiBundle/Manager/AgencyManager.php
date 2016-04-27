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
                                PhotoManager $photoManager,
                                AgentManager $agentManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->photoManager = $photoManager;
        $this->agentManager = $agentManager;
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
            $withPhotos=true,
            $withAgents=false)
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

        
        if (!is_null($agencies)) {
            //with photos
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

            //with agents
            if ($withAgents) {
                if (is_array($agencies)) {
                    foreach ($agencies as $agency) {
                        $agencyId = $agency->getId();
                        $agents = $this->agentManager->load(
                            null, //$id
                            null, //$limit
                            null, //$offset
                            null, //$withDeleted
                            null, //$name
                            null, //$userId
                            $agencyId
                        );
                        $agency->setAgents($agents);
                    }
                } else {
                    $agencyId = $agencies->getId();
                    $agents = $this->agentManager->load(
                            null, //$id
                            null, //$limit
                            null, //$offset
                            null, //$withDeleted
                            null, //$name
                            null, //$userId
                            $agencyId
                    );
                    $agencies->setAgents($agents);

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