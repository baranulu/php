<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Core\BaseDashboardController;
use App\Models\Response;
use Exception;

class DashboardController extends BaseDashboardController
{

    private $brandModel;
    private $brandProductModel;

    public function __construct()
    {
        parent::__construct();
        $this->brandModel = $this->loadModel('brand');
        $this->brandProductModel = $this->loadModel('brandProduct');
    }

    public function index()
    {

        $this->render('front/areas/user/UserDashboard');
    }

    public function updateInformation()
    {
        $response = new Response();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? $this->userInformation->username;
            $email = $_POST['email'] ?? $this->userInformation->email;
            $phone = $_POST['phone'] ?? $this->userInformation->phone;
            $name = $_POST['name'] ?? $this->userInformation->name;
            $surname = $_POST['surname'] ?? $this->userInformation->surname;

            if (empty($username) || empty($name) || empty($surname) || empty($phone)) {
                $response->exception = 'Tüm alanlar zorunludur.';
                $this->render('front/areas/user/UpdateUserInformation', ['response' => $response]);
                return $response;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response->exception = 'Geçerli bir e-posta adresi girin.';
                $this->render('front/areas/user/UpdateUserInformation', ['response' => $response]);
                return $response;
            }

            $user_id = $_SESSION['user_id'];

            $updateData = $this->userModel->update($user_id, $name, $surname, $phone, $email, $username);

            if (!$updateData) {
                $response->exception = "Güncelleme başarısız. Lütfen tekrar deneyiniz.";
                $this->render('front/areas/user/UpdateUserInformation', ['response' => $response]);
                return $response;
            }

            $this->refreshUserInformation();
            $response->result = true;
            $this->render('front/areas/user/UserDashboard', ['response' => $response]);
            return $response;
        } else {
            $this->render('front/areas/user/UpdateUserInformation');
            return $response;
        }
    }

    public function GetBrandAndBrandProduct()
    {
        $categoryId = $_GET['category_id'] ?? null;

        if (empty($categoryId) || !is_numeric($categoryId) || $categoryId <= 0) {
            return $this->jsonError("Geçersiz kategori ID", "VALIDATION_ERROR");
        }


        $data= $this->brandModel->GetBrandAndBrandProduct($categoryId);
        
        $jsonResponse= $this->jsonResponse($data);


    }
}

// 29.05.2025 yapılacak.

// serviceresponse yapısı kontrollerda oluşturulacak. modelden saf veri alınacak.
// parametre validation controller tarafında yapılacak.
// dashboard tarafında yapılan tüm işlemler read write farketmez. Dashboard controllerda olacak.
