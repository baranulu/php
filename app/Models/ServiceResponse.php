<?php 
 namespace App\Models;

// ServiceResponse.php (Genel Response Model)
class ServiceResponse {
    public $success;
    public $data;
    public $message;
    public $errorCode;
    
    public static function success($data, $message = "Operation successful") {
        $response = new self();
        $response->success = true;
        $response->data = $data;
        $response->message = $message;
        $response->errorCode = null;
        return $response;
    }
    
    public static function error($message, $errorCode = null, $data = null) {
        $response = new self();
        $response->success = false;
        $response->data = $data;
        $response->message = $message;
        $response->errorCode = $errorCode;
        return $response;
    }

    public function toArray() {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'message' => $this->message,
            'error_code' => $this->errorCode
        ];
    }
}
?>