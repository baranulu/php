<?php

namespace App\Controllers\Front;


use App\Core\BaseController;
use App\Models\Response;

class AboutsController extends BaseController
{
    private $aboutModel;

    public function index()
    {
        $response = new Response();

        $this->aboutModel = $this->loadModel('About');

        $aboutData = $this->aboutModel->getAbout();

        $response->value = $aboutData->value;
        $response->result = $aboutData->result;
        $response->exception = $aboutData->exception;

        $this->render('front/about/index', [$response], 200);

    }

}
