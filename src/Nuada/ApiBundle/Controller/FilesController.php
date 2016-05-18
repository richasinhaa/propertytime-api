<?php

namespace Nuada\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Files Controller
 *
 * @Route("/files")
 */
class FilesController extends Controller
{
    /**
     * Post files
     *
     * @Method({"POST"})
     *
     * @return array
     */
    public function postFilesAction()
    {
        $requestParams = $this->getRequest()->request->all();
        $file = $this->getRequest()->files;
        $fileManager = $this->get('nuada_api.file_manager');
        try {
            $files = $fileManager->add($file);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if (is_null($files)) {
            $message = 'failed';
        } else {
            $message = 'success';
        }

        return View::create(array('message' => $message), Codes::HTTP_OK);
    }
}
