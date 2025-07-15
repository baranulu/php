<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Core\BaseDashboardController;
use App\Models\Response;
use Exception;
use App\Models\ServiceResponse;

class DashboardController extends BaseDashboardController
{

  private $brandModel;
   

    public function __construct()
    {
        parent::__construct();

        $this->brandModel = $this->loadModel('brand');
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
    ob_clean();
    header('Content-Type: application/json'); // Her durumda tek bir yerde

    try {
        $categoryId = $_GET['subCatId'] ?? null;

        error_log("subCatId: " . var_export($categoryId, true));

        if (empty($categoryId) || !is_numeric($categoryId) || $categoryId <= 0) {
            http_response_code(400);
            echo json_encode(ServiceResponse::error("Geçersiz kategori ID", "VALIDATION_ERROR")->toArray());
            return;
        }

        $response = $this->brandModel->GetBrands($categoryId);

        http_response_code($response->success ? 200 : 400);
        print_r(json_encode($response->toArray()));
        return json_encode($response->toArray());

        exit;

    } catch (\Exception $ex) {
        error_log("GetBrandAndBrandProduct: " . $ex->getMessage());

        http_response_code(500);
        return json_encode(ServiceResponse::error("Sunucu hatası oluştu", "SERVER_ERROR")->toArray());
    }
}

}

// 29.05.2025 yapılacak.

// serviceresponse yapısı kontrollerda oluşturulacak. modelden saf veri alınacak.
// parametre validation controller tarafında yapılacak.
// dashboard tarafında yapılan tüm işlemler read write farketmez. Dashboard controllerda olacak.
