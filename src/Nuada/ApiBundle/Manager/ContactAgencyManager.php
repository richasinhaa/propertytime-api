<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\ContactAgency;

class ContactAgencyManager
{
    protected $doctrine;
    protected $securityContext;
    protected $photoManager;
    protected $legacyConnection;

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

    public function contact($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $agencyId = !empty($requestParams['agency_id']) ? $requestParams['agency_id'] : null;
                $name = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $phone = !empty($requestParams['phone']) ? $requestParams['phone'] : null;
                $email = !empty($requestParams['email'])? $requestParams['email'] : null;
                $customerType = !empty($requestParams['customer_type'])? $requestParams['customer_type'] : null;
                $enquiry = !empty($requestParams['enquiry']) ? $requestParams['enquiry'] : null;
                $keepInformed = !empty($requestParams['keep_informed']) ? $requestParams['keep_informed'] : false;

                if (is_null($name) 
                    || is_null($agencyId) 
                    || is_null($phone)
                    || is_null($email) 
                    || is_null($customerType)
                    || is_null($enquiry)) {
                    throw new BadAttributeException('Agency Id or Name or phone or email or customer type or enquiry empty');
                }

                $contactAgency = new ContactAgency();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $contactAgency->setCreatedOn(new \DateTime('now'));
                    $contactAgency->setModifiedOn(new \DateTime('now'));
                    $contactAgency->setDeleted(false);
                    $contactAgency->setAgencyId($agencyId);
                    $contactAgency->setName($name);
                    $contactAgency->setPhone($phone);
                    $contactAgency->setEmail($email);
                    $contactAgency->setCustomerType($customerType);
                    $contactAgency->setEnquiry($enquiry);
                    $contactAgency->setKeepInformed($keepInformed);

                    $em = $this->doctrine->getManager();
                    $em->persist($contactAgency);
                    $em->flush();
                    $conn->commit();

                    return true;
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

     public function load(
            $id=null,
            $limit=null,
            $offset=null,
            $withDeleted=null,
            $name=null,
            $phone=null,
            $email=null,
            $customerType=null,
            $agencyId=null)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:ContactAgency');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        $contactAgencies = $er->retrieveAll(
            $id,
            $limit,
            $offset,
            $withDeleted,
            $name,
            $phone,
            $email,
            $customerType,
            $agencyId);

        return $contactAgencies;

    }

}