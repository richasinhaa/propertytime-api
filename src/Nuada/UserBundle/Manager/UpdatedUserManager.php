<?php

namespace Nuada\UserBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\UserBundle\Entity\UpdatedUser;

class UpdatedUserManager
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

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId        = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $email         = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $phone         = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $adminApproved = !empty($requestParams['approved']) ? $requestParams['approved'] : false;


                if (empty($userId)) {
                    throw new BadAttributeException('Request has null value for user id');
                } 

                if (empty($email) && empty($phone)) {
                    throw new BadAttributeException('Request cannot have null value for both email and phone');
                } 

                $er = $this->doctrine->getManager()->getRepository('UserBundle:UpdatedUser');
                $updatedUser = new UpdatedUser();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $updatedUser->setCreatedAt(new \DateTime('now'));
                    $updatedUser->setModifiedAt(new \DateTime('now'));
                    $updatedUser->setAdminApproved(false);
                    $updatedUser->setDeleted(false);
                    $updatedUser->setUserId($userId);
                    $updatedUser->setEmail($email);
                    $updatedUser->setPhoneNumber($phone);
                    $updatedUser->setAdminApproved($adminApproved);

                    $em = $this->doctrine->getManager();
                    $em->persist($updatedUser);
                    $em->flush();
                    $conn->commit();

                    return $updatedUser;
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

    public function update($updatedUser, $requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $userId        = !empty($requestParams['user_id']) ? $requestParams['user_id'] : null;
                $email         = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $phone         = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $adminApproved = !empty($requestParams['approved']) ? $requestParams['approved'] : false;

                $er = $this->doctrine->getManager()->getRepository('UserBundle:UpdatedUser');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $updatedUser->setModifiedAt(new \DateTime('now'));
                    $updatedUser->setDeleted(false);
                    if (!is_null($userId)) {
                        $updatedUser->setUserId($userId);
                    }

                    if (!is_null($email)) {
                        $updatedUser->setEmail($email);
                    }

                    if (!is_null($phone)) {
                        $updatedUser->setPhoneNumber($phone);
                    }
                    
                    if (!is_null($adminApproved)) {
                        $updatedUser->setAdminApproved($adminApproved);
                    }

                    $em = $this->doctrine->getManager();
                    $em->persist($updatedUser);
                    $em->flush();
                    $conn->commit();
                    
                    return $updatedUser;
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

    public function load($id) {
        if (is_null($id)) {
            return null;
        }

        $er = $this->doctrine->getManager()->getRepository('UserBundle:UpdatedUser');

        return $er->retrieve($id);
    }

}