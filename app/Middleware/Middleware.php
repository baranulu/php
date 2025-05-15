<?php

namespace App\Middleware;


class AuthMiddleware
{
    /**
     * İstekleri ele alır ve kullanıcı oturumunu kontrol eder.
     * Eğer oturum yoksa, kullanıcıyı giriş sayfasına yönlendirir.
     */
    public function handle()
    {
        // Oturum başlatılmamışsa oturumu başlat
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Kullanıcı oturumu yoksa giriş sayfasına yönlendir
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }
}

?>

## 📌 `AuthMiddleware` Nedir?
`AuthMiddleware` sınıfı, kullanıcı oturumlarını kontrol eden ve yetkilendirme işlemlerini gerçekleştiren bir ara katman yazılımıdır. Bu middleware, belirli sayfalara yetkisiz erişimi engelleyerek kullanıcıları oturum açmaya zorlar.

---

## 🏗️ `AuthMiddleware` Nasıl Çalışır?

`AuthMiddleware`, gelen HTTP isteğini kontrol ederek, kullanıcının oturumunun olup olmadığını denetler. Eğer oturum yoksa, kullanıcıyı `/login` sayfasına yönlendirir. Bu işlem aşağıdaki adımlarla gerçekleştirilir:

1. **Oturum Durumu Kontrol Edilir**
   - `session_status()` fonksiyonu kullanılarak, bir oturumun başlatılıp başlatılmadığı kontrol edilir.
   - Eğer oturum başlatılmamışsa `session_start()` ile oturum başlatılır.

2. **Kullanıcının Giriş Yapıp Yapmadığı Kontrol Edilir**
   - `$_SESSION['user_id']` değişkeni kullanılarak, kullanıcının oturum açıp açmadığı kontrol edilir.
   - Eğer oturum açmamışsa, kullanıcı `/login` sayfasına yönlendirilir.

---