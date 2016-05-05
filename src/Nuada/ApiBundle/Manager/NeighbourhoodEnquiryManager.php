<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\NeighbourhoodEnquiry;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;

class NeighbourhoodEnquiryManager
{
    protected $doctrine;
    protected $securityContext;
    protected $neighbourhoodManager;

    const BUY = 'Buy';
    const RENT = 'Rent';



    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                NeighbourhoodManager $neighbourhoodManager)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->neighbourhoodManager = $neighbourhoodManager;
    }

    public function add($requestParams = null)
    {

        try {
            if (!empty($requestParams)) {
                $neighbourhoodName = $requestParams['neighbourhood'] ? $requestParams['neighbourhood'] : null;
                $name            = $requestParams['name'] ? $requestParams['name'] : null;
                $email           = $requestParams['email'] ? $requestParams['email'] : null;
                $phone           = $requestParams['phone'] ? $requestParams['phone'] : null;
                $type            = $requestParams['type'] ? $requestParams['type'] : null;

                if (is_null($neighbourhoodName)) {
                    throw new BadAttributeException('neighbourhood cant be null in the request');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:NeighbourhoodEnquiry');
                $neighbourhoodEnquiry = new NeighbourhoodEnquiry();
                $neighbourhood = $this->neighbourhoodManager->load(
                        null, //$id
                        $neighbourhoodName
                    );
                if (empty($neighbourhood)) {
                    throw new BadAttributeException('Neighbourhood with name '. $neighbourhoodName. ' doesnot exist');
                }

                $neighbourhoodId = $neighbourhood[0]->getId();


                if (!is_null($type)) {
                    if ($type == self::BUY || $type == self::RENT) {
                        $conn = $this->doctrine->getConnection();
                        try {
                            $conn->beginTransaction();
                            $neighbourhoodEnquiry->setCreatedAt(new \DateTime('now'));
                            $neighbourhoodEnquiry->setNeighbourhoodId($neighbourhoodId);
                            $neighbourhoodEnquiry->setContactName($name);
                            $neighbourhoodEnquiry->setEmail($email);
                            $neighbourhoodEnquiry->setPhone($phone);
                            $neighbourhoodEnquiry->setType($type);
                            $neighbourhoodEnquiry->setDeleted(false);
                            $em = $this->doctrine->getManager();
                            $em->persist($neighbourhoodEnquiry);
                            $em->flush();
                            $conn->commit();

                            return $neighbourhoodEnquiry;
                        } catch (\Exception $e) {
                            $conn->rollback();
                            throw $e;
                        }
                    } else {
                        throw new BadAttributeException('Unknown type '. $type. '. Accepted values - Buy/Rent.');
                    }

                } else {
                    throw new BadAttributeException('type cant be null in the request');
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