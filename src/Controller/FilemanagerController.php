<?php

namespace RMF\Controller;

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
 * Created by PhpStorm.
 * User: fpokoj
 * Date: 03.01.18
 * Time: 11:42
 */
class FilemanagerController extends Controller
{
    private $config = [];

    /**
     * @Route(name="rmf_filemanager", path="/filemanager")
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