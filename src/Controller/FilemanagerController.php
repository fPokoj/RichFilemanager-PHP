<?php

namespace RFM\Controller;

use RFM\Api\LocalApi;
use RFM\Application;
use RFM\Repository\Local\Storage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

setlocale(LC_CTYPE, 'en_US.UTF-8');

if(!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}

/**
 * Page controller.
 * @Route("/")
 */
class FilemanagerController extends Controller
{
    private $config = [
        'options' => [
            'fileRoot' => 'PATH TO FILE',
            'serverRoot' => 'PATH TO FILE'
        ]
    ];

    /**
     * Filemanager
     *
     * @Route("/filemanager-connect", name="filemanager-connect")
     * @Method("GET")
     * @Template()
     */
    public function fileManagerAction(Request $request)
    {
        $app = new Application();
        $local = new Storage($this->config);

        $app->setStorage($local);

        $app->api = new LocalApi();

        $app->run();

        return new JsonResponse();
    }

}