<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Advertisement;

class AdvertisementManager
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
            $limit=null,
            $offset=null,
            $path=null,
            $redirectTo=null,
            $page=null,
            $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Advertisement');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $advertisements = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $path,
            $redirectTo,
            $page,
            $withDeleted
        );

        return $advertisements;

    }

    public function getCount(
            $id=null,
            $path=null,
            $redirectTo=null,
            $page=null,
            $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Advertisement');

        $count = $er->fetchCount(
            $id,
            $path,
            $redirectTo,
            $page,
            $withDeleted);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $path = !empty($requestParams['path']) ? $requestParams['path'] : null;
                $redirectTo = !empty($requestParams['redirect_to']) ? $requestParams['redirect_to'] : null;
                $page = !empty($requestParams['page']) ? $requestParams['page'] : null;

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Advertisement');
                $advertisement = new Advertisement();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $advertisement->setCreatedAt(new \DateTime('now'));
                    $advertisement->setDeleted(false);
                    $advertisement->setPath($path);
                    $advertisement->setRedirectTo($redirectTo);
                    $advertisement->setPage($page);

                    $em = $this->doctrine->getManager();
                    $em->persist($advertisement);
                    $em->flush();
                    $conn->commit();

                    return $advertisement;
                } catch (\Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

            } else {
                throw new BadAttributeException('Empty request parameters');
            }
        } catch(Exception $e) {
            throw $e;
        }

        return null;

    }

    public function delete($advertisement) {
        try {
            $advertisement->setDeleted(true);
            $em = $this->doctrine->getManager();
            $em->persist($advertisement);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}