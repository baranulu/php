<?php 
namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Models\Response;

class BlogController extends 
BaseController
{
    private $blogModel;

    public function __construct()
    {
        parent::__construct();
        $this->blogModel = $this->loadModel('Blog');
    }

    public function index()
    {
        $response = new Response();

        $data = $this->blogModel->getBlogData();

        $response->value = $data->value;
        $response->result = $data->result;
        $response->exception = $data->exception;

        $this->render('front/blog/index', ['response'=>$response], 200);
    }

    public function detail($slug)
    {
        $response = new Response();

        $data = $this->blogModel->getBlogDetailWithSlug($slug);

        $response->value = $data->value;
        $response->result = $data->result;
        $response->exception = $data->exception;
        
        $this->render('front/blog/detail', ['response'=>$response], 200);
    }
}

?> 