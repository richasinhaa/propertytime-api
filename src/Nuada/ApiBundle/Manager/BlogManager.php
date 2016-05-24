<?php

namespace Nuada\ApiBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Finder\Finder;
use Doctrine\DBAL\Connection;
use Nuada\ApiBundle\Entity\BadAttributeException;
use Nuada\ApiBundle\Entity\Blog;

class BlogManager
{
    protected $doctrine;
    protected $securityContext;

    const LIMIT = 25;
    const OFFSET = 0;

    public function __construct(Doctrine $doctrine,
                                SecurityContextInterface $securityContext,
                                ValidatorInterface $validator,
                                Connection $legacyConnection)
    {
        $this->doctrine = $doctrine;
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->legacyConnection = $legacyConnection;
    }

    public function load($id=null,
                         $limit=null,
                         $offset=null,
                         $name=null,
                         $type=null,
                         $blogUrl=null,
                         $from=null,
                         $to=null,
                         $all=false,
                         $allTypes=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Blog');

        $limit = $limit ? $limit : self::LIMIT;
        $offset = $offset ? $offset : self::OFFSET;

        if ($limit && $allTypes) {
            $blogs = $this->fetchAllTypes($limit, $allTypes);
        } else {
            $blogs = $er->retrieveAll(
                $id,
                $limit,
                $offset,
                $name,
                $type,
                $blogUrl,
                $from,
                $to,
                $all
            );
        }

        return $blogs;

    }

    public function getCount(
        $id=null,
        $name=null,
        $type=null,
        $blogUrl=null,
        $from=null,
        $to=null,
        $all=false,
        $allTypes=false)
    {
        $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Blog');

        $count = $er->fetchCount(
            $id,
            $name,
            $type,
            $blogUrl,
            $from,
            $to,
            $all,
            $allTypes);

        return intval($count);

    }

    public function add($requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $name        = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $type        = !empty($requestParams['type']) ? $requestParams['type'] : null;
                $description = !empty($requestParams['description']) ? $requestParams['description'] : null;
                $blogUrl     = !empty($requestParams['blog_url']) ? $requestParams['blog_url'] : null;
                $imagePath   = !empty($requestParams['image_path']) ? $requestParams['image_path'] : null;
                $visible     = !empty($requestParams['visible']) ? $requestParams['visible'] : true;

                if (is_null($name) || is_null($blogUrl)) {
                    throw new BadAttributeException('Request has null value for blog name or blog url');
                }

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Blog');
                $blog = new Blog();
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $blog->setCreatedAt(new \DateTime('now'));
                    $blog->setModifiedAt(new \DateTime('now'));
                    $blog->setName($name);
                    $blog->setType($type);
                    $blog->setDescription($description);
                    $blog->setBlogUrl($blogUrl);
                    $blog->setImagePath($imagePath);
                    $blog->setVisible($visible);

                    $em = $this->doctrine->getManager();
                    $em->persist($blog);
                    $em->flush();
                    $conn->commit();

                    return $blog;
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

    public function update($blog, $requestParams = null)
    {
        try {
            if (!empty($requestParams)) {
                $name        = !empty($requestParams['name']) ? $requestParams['name'] : null;
                $type        = !empty($requestParams['type']) ? $requestParams['type'] : null;
                $description = !empty($requestParams['description']) ? $requestParams['description'] : null;
                $blogUrl     = !empty($requestParams['blog_url']) ? $requestParams['blog_url'] : null;
                $imagePath   = !empty($requestParams['image_path']) ? $requestParams['image_path'] : null;
                $visible     = $requestParams['visible'];

                $er = $this->doctrine->getManager()->getRepository('NuadaApiBundle:Blog');
                $conn = $this->doctrine->getConnection();

                try {
                    $conn->beginTransaction();
                    $blog->setModifiedAt(new \DateTime('now'));

                    if (!is_null($name)) {
                        $blog->setName($name);
                    }
                    if (!is_null($type)) {
                        $blog->setType($type);
                    }
                    if (!is_null($description)) {
                        $blog->setDescription($description);
                    }
                    if (!is_null($blogUrl)) {
                        $blog->setBlogUrl($blogUrl);
                    }
                    if (!is_null($imagePath)) {
                        $blog->setImagePath($imagePath);
                    }
                    if (!is_null($visible)) {
                        $blog->setVisible($visible);
                    }

                    $em = $this->doctrine->getManager();
                    $em->persist($blog);
                    $em->flush();
                    $conn->commit();

                    return $blog;
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

    public function delete($blog) {
        try {
            $blog->setVisible(false);
            $blog->setModifiedAt(new \DateTime('now'));
            $em = $this->doctrine->getManager();
            $em->persist($blog);
            $em->flush();
        } catch(Exception $e) {
            throw $e;
        }

        return true;
    }

    public function fetchAllTypes($limit) {
        $blogs = array();
        $query = $this->legacyConnection->executeQuery("
            select DISTINCT(type) from nl_blogs");

        $blogTypes = $query->fetchAll();
        foreach ($blogTypes as $blogType) {
            $query = $this->legacyConnection->executeQuery("
            select * from nl_blogs
            where type = ?
            and visible = 1
            limit $limit
            ", array($blogType['type']));

            $data = $query->fetchAll();
            foreach ($data as $datum) {
                $blog = $this->hydrate($datum);
                $blogs[] = $blog;
            }
            
            
        }
        
        return $blogs;
    }

    public function hydrate($blogArray) {
        $blog = new Blog();
        $blog->setId($blogArray['id']);
        $blog->setName($blogArray['name']);
        $blog->setType($blogArray['type']);
        $blog->setDescription($blogArray['description']);
        $blog->setBlogUrl($blogArray['blog_url']);
        $blog->setImagePath($blogArray['image_path']);
        $blog->setCreatedAt(new \DateTime($blogArray['created_at']));
        $blog->setModifiedAt(new \DateTime($blogArray['modified_at']));
        $blog->setVisible($blogArray['visible']);

        return $blog;
    }

}