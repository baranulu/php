<!--  Route Yapılandırması ve Kullanımı public/index.php

Bu dokümanda, MVC mimarisine sahip PHP tabanlı bir projede **Route** yönetiminin nasıl yapıldığını adım adım anlatacağız.
 
---

### Route Nedir?**

**Route**, kullanıcının tarayıcıda belirli bir URL'ye eriştiğinde hangi **Controller** ve **Metodun** çağrılacağını belirleyen bir yapılandırmadır.

- Route sistemi, gelen isteklere uygun olarak bir **Controller** sınıfını ve içindeki bir metodu çağırır.
- Dinamik parametreler ile URL'lerde değişkenleri yakalayarak esnek yapı sağlar.
- Middleware entegrasyonu ile yetkilendirme gibi işlemler eklenebilir. -->


<?php
error_reporting(E_ALL); // Tüm hataları raporla
ini_set('display_errors', 1); // Hataları ekranda göster

define('ROOT', __DIR__ . '/..'); //  Proje kök dizinini belirler.);
require_once __DIR__ . '/../vendor/autoload.php';   //Composer autoload dosyasını projeye dahil eder.

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

use App\Middleware\AuthMiddleware;
use App\Core\Route;
use App\Core\BaseController;

Route::add('/', 'Front\HomeController@index');
Route::add('Front/Errors/404', 'Front\ErrorsController@NotFound');
Route::add('abouts', 'Front\AboutsController@index');
Route::add('blog', 'Front\BlogController@index');
Route::add('blog/detail/{slug}', 'Front\BlogController@detail');
Route::add('auth/login', 'Front\AuthController@login');
Route::add('auth/register', 'Front\AuthController@register');
Route::add('areas/user/UserDashboard', 'Front\DashboardController@index');
Route::add('areas/user/UpdateUserInformation', 'Front\DashboardController@updateInformation');
Route::add('areas/user/AddAdvert', 'Front\AdvertController@index');


Route::add('areas/user/api/getBrandAndProductsBySubCategoryId', 'Front\DashboardController@GetBrandAndBrandProduct');



// Bu rotalar:
// - `AuthMiddleware` ile korunarak sadece giriş yapmış kullanıcılara açılır.
Route::add('order', 'Front\OrderController@index')->middleware(AuthMiddleware::class);
Route::add('customer', 'Front\CustomerController@index')->middleware(AuthMiddleware::class);

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($uri === '') {
    $uri = '/';
}

try {
    echo($uri);
    Route::dispatch($uri);
} catch (Exception $e) {

 error_log((new DateTime())->format('Y-m-d H:i:s').''. $e->getMessage());
    (new BaseController())->renderErrors('front/errors/404', 404);
}

?>