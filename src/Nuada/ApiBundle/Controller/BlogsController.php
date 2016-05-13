<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Blogs Controller
 *
 * @Route("/blogs")
 */
class BlogsController extends Controller
{

    /**
     * Get blogs
     *
     * @Method({"GET"})
     *
     * @return array
     */
    public function getBlogsAction()
    {
        $request = $this->get('request');
        $id = $request->query->get('id', null);
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', null);
        $name = $request->query->get('name', null);
        $type = $request->query->get('type', null);
        $blogUrl = $request->query->get('blog_url', null);
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $all = strtolower($request->get('all', 'false')) == 'true';
        $allTypes = strtolower($request->get('all_types', 'false')) == 'true';

        $blogManager = $this->get('nuada_api.blog_manager');
        $blogs = $blogManager->load(
            $id,
            $limit,
            $offset,
            $name,
            $type,
            $blogUrl,
            $from,
            $to,
            $all,
            $allTypes
        );

        $blogCount = $blogManager->getCount(
            $id,
            $name,
            $type,
            $blogUrl,
            $from,
            $to,
            $all,
            $allTypes);

        if (null === $blogs) {
            $blogs = array();
        }

        return View::create(array('blogs' => $blogs), Codes::HTTP_OK);
    }

    /**
     * Post blog
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postBlogsAction()
    {
        $requestParams = $this->getRequest()->request->all();

        $blogManager = $this->get('nuada_api.blog_manager');
        try {
            $blog = $blogManager->add($requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($blog)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'blog' => $blog), Codes::HTTP_OK);
    }

    /**
     * Patch blog
     *
     * @Method({"PATCH"})
     *
     * @return array
     */
    public function patchBlogsAction($id)
    {
        $requestParams = $this->getRequest()->request->all();

        $blogManager = $this->get('nuada_api.blog_manager');
        try {
            $blog = $blogManager->load($id);

            if (is_null($blog[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $updatedBlog = $blogManager->update($blog[0], $requestParams);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($updatedBlog)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message, 'blog' => $updatedBlog), Codes::HTTP_OK);
    }

    public function deleteBlogsAction($id) {
        $blogManager = $this->get('nuada_api.blog_manager');
        try {
            $blog = $blogManager->load($id);

            if (is_null($blog[0])) {
                return View::create(array('message' => 'failed'), Codes::HTTP_NOT_FOUND);
            }

            $response = $blogManager->delete($blog[0]);
            return View::create(array('message' => $response), Codes::HTTP_NOT_FOUND);
        } catch(Exception $e) {
            throw $e;
        }
    }
}
