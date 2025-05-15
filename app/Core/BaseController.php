<?php

namespace App\Core;

use App\Models\Category;

/*
MVC mimarisinde temel kontrolcü olarak kullanılan bu sınıf,
uygulama genelinde oturum yönetimi, ayarlar, kategoriler ve görünümlerin(view) çağrılması gibi işlemleri yönetir.
*/

class BaseController
{
    protected $view;
    protected $model;
    protected $userId;
    protected $settings = [];
    protected $categories = [];
    protected $cartItemCount = 0;

    public function __construct()
    {
        $categoryModel = new Category();
        $this->categories = $categoryModel->getActiveCategories();
    }

    //loadModel yöntemi, belirtilen model sınıfını yüklemek ve bir örneğini oluşturmak için kullanılır. Bu yöntem, model sınıfının adını alır,
    // tam sınıf adını oluşturur ve ardından bu sınıfın yeni bir örneğini $this->model özelliğine atar.
    public function loadModel($model)
    {
        $modelPath = "App\\Models\\$model";

        if (class_exists($modelPath)) {
            return new $modelPath();
        } else {
            throw new \Exception("Model bulunamadı: " . $model);
        }
    }

    // **Açıklama:**
    // - Kullanıcı giriş yapmamışsa, **login sayfasına yönlendirilir.**
    // - Kullanıcı **admin değilse**, ana sayfaya yönlendirilir.
    private function checkLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /');
            exit();
        }
    }

    //     **Açıklama:**
    // - HTTP yanıt kodunu ayarlar.
    // - **Site ayarları, kategoriler ve sepet bilgileri** gibi verileri `$data` değişkenine aktarır.
    // - **`extract($data);`** ile `$data` dizisindeki değişkenleri doğrudan kullanılabilir hale getirir.
    // - Header, içerik (view) ve footer dosyalarını çağırarak **sayfa düzenini oluşturur.**
    public function render($view, $data = [], $statusCode = 200)
    {
        http_response_code($statusCode);

        // $data['settings'] = $this->settings;
        $data['categories'] = $this->categories;

        // $data['cartItemCount'] = $this->cartItemCount;

        // if (isset($_SESSION)) {
        //     $data['session'] = $_SESSION;
        // }

        extract($data);

        require_once __DIR__ . "/../../views/layouts/front/header.php";
        require_once __DIR__ . "/../../views/$view.php";
        require_once __DIR__ . "/../../views/layouts/front/footer.php";
    }

    public function renderErrors($view, $statusCode = 404)
    {
        http_response_code($statusCode);

        require_once __DIR__ . "/../../views/$view.php";
    }
    
    public function renderLoginOrRegister($view,$data=[],$statusCode=200)
    {
        extract($data);

        require_once __DIR__ . "/../../views/$view.php";
    }
}

//TODO
//settings ve categories constructor içinde model sınıflarından veri çekilerek doldurulacak.
//user id ise session'dan çekilecek.
//cardItemCount ise session'dan id alınıp modelden id bazlı çekilecek.
