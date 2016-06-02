<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Document;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FileManager extends FileBag
{
    protected $doctrine;
    protected $securityContext;
    protected $container;


    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                ContainerInterface $container)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->container = $container;
    }

    public function add($file = null)
    {
        try {
            $uploadedFile = $file->get('files');
            $fileName = $uploadedFile->getClientOriginalName();
            $type = $uploadedFile->getClientMimeType();
            $size = $uploadedFile->getClientSize();

            $document = new Document();
            $document->setUploadDirectory($this->container->get('kernel')->getRootDir() .'/uploads/document');
            $document->setFile($file->get('files'));
            $document->setName($fileName);
            $document->setSize($size);
            $document->setType($type);
            $document->setCreatedOn(new \DateTime());
            $document->setDeleted(false);

            $em = $this->doctrine->getManager();
            $result = $document->upload();
            $em->persist($document);
            $em->flush();
        } catch (Exception $e) {
            throw $e;
        }
        $response = array();
        $response['message'] = $result ? true : false;
        $response['document'] = $document;
        
        return $response;
    }


}