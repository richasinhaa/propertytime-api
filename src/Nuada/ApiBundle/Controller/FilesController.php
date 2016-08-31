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
        //type = Agent; for saving agent photos
        $type = !empty($requestParams['type']) ? $requestParams['type'] : null; 
        $fileManager = $this->get('nuada_api.file_manager');
        try {
            $response = $fileManager->add($file, $type);
        } catch (BadAttributeException $e) {
            return View::create($e->getMessage(), Codes::HTTP_BAD_REQUEST);
        }

        if ($response['message']) {
            $message = 'success';
        } else {
            $message = 'failed';
        }

        return View::create(array('message' => $message, 'file' => $response['document']), Codes::HTTP_OK);
    }
}
