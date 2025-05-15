<?php
namespace App\Controllers\Front;
use App\Core\BaseController;
use App\Models\Response;
use App\Models\User;


class UserController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->loadModel('User');
    }

    public function index()
    {
        $response = new Response();

        $data = $this->userModel->getUserData();

        $response->value = $data->value;
        $response->result = $data->result;
        $response->exception = $data->exception;

        $this->render('front/user/index', ['response'=>$response], 200);
    }
}
?>