<?php

namespace Nuada\UserBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;

class UserManager
{
    protected $doctrine;
    protected $securityContext;


    const SUBSCRIBER = 'SUBSCRIBER';
    const ADMIN      = 'ADMIN';
    const COMPANY    = 'COMPANY';

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
    }

    public function load($emailId=null)
    {
        $er = $this->doctrine->getManager()->getRepository('UserBundle:User');

        $user = $er->retrieve($emailId);

        return $user;

    }

    public function updateUserType($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $emailId = !empty($requestParams['email']) ? $requestParams['email'] : null;
                $userType = !empty($requestParams['user_type']) ? $requestParams['user_type'] : null;

                if (empty($emailId)) {
                    throw new BadAttributeException('Request has null value for email id');
                } 

                if (empty($userType)) {
                    throw new BadAttributeException('Request has null value for user type');
                }

                if ($userType !== self::SUBSCRIBER && $userType !== self::ADMIN && $userType !== self::COMPANY) {
                    throw new BadAttributeException('Wrong user type. Possible values '.self::SUBSCRIBER.', '.self::ADMIN.', '.self::COMPANY);
                }

                $user = $this->load($emailId)[0];

                if(empty($user)) {
                    throw new BadAttributeException('User with this email id doesnot exist');
                }

                $er = $this->doctrine->getManager()->getRepository('UserBundle:User');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $user->setUserType($userType);

                    $em = $this->doctrine->getManager();
                    $em->persist($user);
                    $em->flush();
                    $conn->commit();

                    return $user;
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
}