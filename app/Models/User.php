<?php

namespace App\Models;

use App\Models;
use PDO;
use PDOException;

class User extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addUser($username, $email, $password)
{
    $response = new Response();

    $db = $this->db;

    try {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashedPassword);
        $query->execute();

        $response->result = true;
        $response->value = $db->lastInsertId();

    } catch (PDOException $e) {
        // Hata mesajını kullanıcıya gösterilecek şekilde ayarlıyoruz
        $response->result = false;
        $response->exception = 'Beklenmedik bir hata oluştu. Lütfen daha sonra tekrar deneyin.';

        $logMessage = "[" . date('Y-m-d H:i:s') . "] Genel hata: " . $e->getMessage() . "\n";
        
        error_log($logMessage, 3, __DIR__ . '/../../logs/error.log');
        
    } 

    return $response;
}

    public function getByUsername($username){

        $response = new Response();

        $db=$this->db;

        try 
        {
            $query = $db->prepare("select * from users where username=:username");
            $query->bindParam(':username', $username);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);

            if (empty($result)) {
                $response->exception = 'Kullanıcı bulunamadı.';
                $response->result = false;
                return $response;
            }

            $response->value = $result;

            $response->result = true;

        } catch (PDOException $e) {

            $response->value = [];
            $response->result = false;
            $response->exception = 'Veritabanı hatası: ' . $e->getMessage();
        }
    }
    public function login($username, $password)
    {
        $response = new Response();

        $db = $this->db;

        try {
            $query = $db->prepare("SELECT * FROM users WHERE username = :username");
            $query->bindParam(':username', $username);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($password, $user->password)) {
                // Şifre doğruysa, kullanıcı bilgilerini döndür
                unset($user->password); // Şifreyi gizle
                $response->result = true;
                $response->value = $user;
            } else {
                // Şifre yanlışsa veya kullanıcı bulunamadıysa
                $response->result = false;
                $response->exception = 'Kullanıcı Adı veya şifre hatalı.';
               
            }
        } catch (PDOException $e) {
            // Veritabanı hatası durumunda
            $response->result = false;
            $response->exception = 'Veritabanı hatası: ' . $e->getMessage();
        }
    
        return $response;
    }
}
?>