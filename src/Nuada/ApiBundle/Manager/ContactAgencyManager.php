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
    protected $agencyManager;
    protected $legacyConnection;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                AgencyManager $agencyManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->agencyManager = $agencyManager;
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
                    || is_null($phone)
                    || is_null($email) 
                    || is_null($customerType)
                    || is_null($enquiry)) {
                    throw new BadAttributeException('Name or phone or email or customer type or enquiry empty');
                }

                $contactAgency = new ContactAgency();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $agency = $this->agencyManager->load($agencyId);
                    /*if (!$agency) {
                         throw new BadAttributeException('Agency with id '. $agencyId. ' cannot be found');
                    }*/

                    $agencyEmail = null;
                    $agencyName = null;

                    if ($agency) {
                        $agencyEmail = $agency->getEmail();
                        $agencyName = $agency->getName();
                    }

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
                    try {
                        if ($agencyName && $agencyEmail) {
                            $this->sendLeadMail($name, $email, $phone, $agencyEmail, $agencyName);
                        } else {
                            $this->sendQueryMail($name, $email, $phone, $enquiry);
                        }
                    } catch (Exception $e) {
                        return true;
                    }

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

    public function sendQueryMail($name, $email, $phone, $enquiry) 
    {
        $to = 'admin@nuadalabs.com';
        $subject = 'Lead Generated From Propertytime';

        // message
        $message = '
        <html>
        <head>
          <title>New Query From Propertytime Website Contact Form</title>
        </head>
        <body>
         <table>
            <tr>
              <td>Name : </td><td>';
              $message = $message . $name;
              $message = $message . '</td>
            </tr>
            <tr>
              <td>Email : </td><td>';
              $message = $message . $email;
              $message = $message . '</td>
            </tr>
            <tr>
              <td>Contact Number : </td><td>';
              $message = $message . $phone;
              $message = $message . '</td>
            </tr>
            <tr>
              <td>Message : </td><td>';
              $message = $message . $enquiry;
              $message = $message . '</td>
            </tr>
          </table>
        </body>
        </html>
        '; 

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: propertytime.ae <admin@propertytime.ae>' . "\r\n";
        $headers .= 'Cc: info@propertytime.ae' . "\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }

    public function sendLeadMail($name, $email, $phone, $to, $agencyName) 
    {
        $to = 'admin@nuadalabs.com';
        $subject = 'Lead Generated From Propertytime';

        // message
        $message = '
        <html>
        <head>
          <title>Lead Generated From Propertytime</title>
        </head>
        <body>
          <p>New Lead Generated for <b>';
          $message = $message . $agencyName;
          $message = $message . '</b> </p>
          <table>
            <tr>
              <td>Name : </td><td>';
              $message = $message . $name;
              $message = $message . '</td>
            </tr>
            <tr>
              <td>Email : </td><td>';
              $message = $message . $email;
              $message = $message . '</td>
            </tr>
            <tr>
              <td>Contact Number : </td><td>';
              $message = $message . $phone;
              $message = $message . '</td>
            </tr>
          </table>
        </body>
        </html>
        '; 

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: propertytime.ae <admin@propertytime.ae>' . "\r\n";
        $headers .= 'Cc: info@propertytime.ae' . "\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }

}