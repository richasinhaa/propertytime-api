<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Favorite;

class FavoriteManager
{
    protected $doctrine;
    protected $securityContext;
    protected $listingManager;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                ListingManager $listingManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->listingManager = $listingManager;
    }

    public function load($id=null,
                         $limit=null,
                         $offset=null,
                         $userId=null,
                         $listingId=null,
                         $withDeleted=false,
                         $withListing=true)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Favorite');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $favorites = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $userId,
            $listingId,
            $withDeleted
        );

        if (is_array($favorites)) {
            if ($withListing) {
                foreach ($favorites as $favorite) {
                    $listingId = $favorite->getListingId();
                    $listing = $this->listingManager->load($listingId);
                    $favorite->setListing($listing);
                }
            }
        }

        return $favorites;

    }

    public function getCount(
        $id=null,
        $userId=null,
        $listingId=null,
        $withDeleted=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Favorite');

        $count = $er->fetchCount(
            $id,
            $userId,
            $listingId,
            $withDeleted);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId      = $requestParams['user_id'] ? $requestParams['user_id'] : null;
                $listingId   = $requestParams['listing_id'] ? $requestParams['listing_id'] : null;
                $liked       = $requestParams['liked'] ? true : false;

                if (is_null($userId) || is_null($listingId) || is_null($requestParams['liked'])) {
                    throw new BadAttributeException('Request has null value for user_id or listing_id or liked');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Favorite');
                $favorite = new Favorite();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $favorite->setCreatedOn(new \DateTime('now'));
                    $favorite->setModifiedOn(new \DateTime('now'));
                    $favorite->setDeleted(false);
                    $favorite->setUserId($userId);
                    $favorite->setListingId($listingId);
                    $favorite->setLiked($liked);

                    $em = $this->doctrine->getManager();
                    $em->persist($favorite);
                    $em->flush();
                    $conn->commit();

                    return $favorite;
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

    public function update($favorite, $requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId      = $requestParams['user_id'] ? $requestParams['user_id'] : null;
                $listingId   = $requestParams['listing_id'] ? $requestParams['listing_id'] : null;
                $liked       = $requestParams['liked'] ? true : false;

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Favorite');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $favorite->setModifiedOn(new \DateTime('now'));
                    $favorite->setDeleted(false);
                    $favorite->setUserId($userId);
                    $favorite->setListingId($listingId);
                    $favorite->setLiked($liked);

                    $em = $this->doctrine->getManager();
                    $em->persist($favorite);
                    $em->flush();
                    $conn->commit();

                    return $favorite;
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

    public function delete($favorite) {
        try {
            $favorite->setDeleted(true);
            $favorite->setModifiedOn(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($favorite);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

}