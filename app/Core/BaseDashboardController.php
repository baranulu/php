<?php
namespace App\Core;

use App\Models\User;
use App\Models\ServiceResponse;



class BaseDashboardController {

    protected $userModel;
    protected $userInformation;
    protected $user_id;

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

     $this->user_id = $_SESSION['user_id'] ?? null;
     $this->userModel = new User();
     $this->userInformation = $this->userModel->userInformation($this->user_id);       
    }

      public function loadModel($model)
    {
        $modelPath = "App\\Models\\$model";

        if (class_exists($modelPath)) {
            return new $modelPath();
        } else {
            throw new \Exception("Model bulunamadı: " . $model);
        }
    }

    public function refreshUserInformation()
    {
        if ($this->user_id) {
            $this->userInformation = $this->userModel->userInformation($this->user_id);
            return true;
        }
        return false;
    }

    public function render($view, $data = [], $statusCode = 200)
    {
        http_response_code($statusCode);

        $data['userInformation'] = $this->userInformation;


        if (isset($_SESSION)) {
            $data['session'] = $_SESSION;
        }

        extract($data);

        require_once __DIR__ . "/../../views/front/areas/layouts/dashboardHeader.php";
        require_once __DIR__ . "/../../views/$view.php";
        // require_once __DIR__ . "/../../views/layouts/front/footer.php";
    }

    protected function jsonSuccess($data, $message = "Success") {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'data' => $data,
            'message' => $message
        ]);
        exit;
    }

    protected function jsonError($message, $errorCode = "ERROR", $httpCode = 400) {
        header('Content-Type: application/json');
        http_response_code($httpCode);
        echo json_encode([
            'success' => false,
            'data' => null,
            'message' => $message,
            'error_code' => $errorCode
        ]);
        exit;
    }

        protected function jsonResponse(ServiceResponse $response) {
        header('Content-Type: application/json');
        
        if ($response->success) {
            http_response_code(200);
        } else {
            // Error koduna göre HTTP status belirle
            $httpCode = match($response->errorCode) {
                'VALIDATION_ERROR' => 400,
                'NOT_FOUND' => 404,
                'DB_ERROR' => 500,
                default => 500
            };
            http_response_code($httpCode);
        }
        
        echo json_encode($response->toArray());
        exit;
    }
}

?>