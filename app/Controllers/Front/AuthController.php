<?php
namespace App\Controllers\Front;
use App\Core\BaseController;
use App\Models\Response;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key; 
use App\Core\Config;
use EmptyIterator;

class AuthController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->loadModel('User');
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $response = new Response();  // Response nesnesi oluşturuluyor
    
        // Eğer form POST ile gelirse (login formu gönderildiyse)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Form verilerini alıyoruz
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Kullanıcı login fonksiyonu ile doğrulanıyor
            $loginData = $this->userModel->login($username, $password);
    
            // Eğer giriş başarılıysa
            if ($loginData->result) {
                $_SESSION['user_id'] = $loginData->value->id;
                $_SESSION['username'] = $loginData->value->username;
                $_SESSION['role_id'] = $loginData->value->role_id;

                $_SESSION['TOKEN'] = $this->createToken($loginData->value->id, $loginData->value->email);
                
                // Başarıyla giriş yapıldıysa anasayfaya yönlendiriyoruz
                header('Location: /');
                exit();
            } else {
                // Giriş başarısızsa, hata mesajını gösteriyoruz
                $response->exception = $loginData->exception ?: 'Kullanıcı adı veya şifre hatalı!';
                $response->result = false;
             
                // Login sayfasına hata mesajı ile render ediyoruz
                // Burada 'response' olarak gönderiyoruz, değil 'exception'
                $this->renderLoginOrRegister('front/auth/login', ['response' => $response], 200);
            }
        } else {
            // Eğer form GET ile gelirse login sayfasını render ediyoruz
            $this->renderLoginOrRegister('front/auth/login',[]);
        }
    }
function register()
    {
        $response = new Response();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role_id=2;
            $phone= $_POST['phone'] ??'';
            $name =$_POST['name']??'';
            $surname= $POST['surname']??'';
    
            // Veri doğrulama
            if (empty($username) || empty($phone) || empty($email) || empty($password)) {
                $response->exception = 'Tüm alanlar zorunludur.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response->exception = 'Geçerli bir e-posta adresi girin.';
            } else {
                $registerData = $this->userModel->addUser($username, $email, $password,$role_id,$name,$surname,$phone);
    
                if ($registerData->result) {
                    header('Location: /auth/login');
                    exit();
                } else {
                    $response->exception = $registerData->exception ?: 'Kayıt başarısız! Lütfen bilgilerinizi kontrol edin.';
                }
            }
    
            $this->renderLoginOrRegister('front/auth/register', ['response' => $response], 200);
        } else {

            $this->renderLoginOrRegister('front/auth/register', ['response' => $response], 200);
        }
    }

    public function logout()
    {
        session_destroy();

        header('Location: auth/login');
        
        exit();
    }

    function createToken($userId, $mail)
    {
        try 
        {
            $secretKey = Config::get('JWT_SECRET');

         $issuedAt = time();

             $expirationTime = $issuedAt + Config::get('JWT_EXPIRATION'); // Token geçerlilik süresi (1 saat)

            $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'userId' => $userId,
            'mail' => $mail
            ];

            $jwt = JWT::encode($payload, $secretKey, 'HS256');

            echo $jwt;

            return $jwt;

        } 
        catch (\Exception $e) {
            // JWT kütüphanesi yüklenemediğinde hata mesajı döndür
            return 'JWT kütüphanesi yüklenemedi: ' . $e->getMessage();
        }
     

    }

    function verifyToken($token) {
        $secretKey = 'gizliAnahtar123';
    
        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return null; // Geçersiz ya da süresi dolmuş
        }
    }

}
?>