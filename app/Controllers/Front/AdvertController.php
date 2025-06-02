<?php

namespace App\Controllers\Front;

use App\Core\BaseDashboardController;
use App\Models\Response;
use Error;
use Exception;

class AdvertController extends BaseDashboardController
{
    protected $categories;
    protected $subcategories;
    protected $categoriesModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoriesModel = $this->loadModel('Category');

        $this->loadCategories();
    }

    public function loadCategories()
    {
        try {
            $this->categories = $this->categoriesModel->GetActiveCategories();
        } catch (Exception $ex) {
            error_log("Kategoriler yüklenirken hata oluştu." . $ex->getMessage());
        }
    }

 public function index()
{
    $data = [];

    try {
        // Sadece POST istekleri handlePostRequest'e yönlendirilir
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($data);
            return;
        }

        if (empty($this->categories)) {
            $this->render('front/areas/user/AddAdvert', [
                'error' => 'Kategoriler alınırken hata oluştu veya kategori listesi boş.'
            ]);
            return;
        }

        $step = isset($_POST['step']) && is_numeric($_POST['step']) ? (int)$_POST['step'] : 1;

        $data = [
            'categories' => $this->categories,
            'page_title' => 'Yeni İlan Ekle',
            'step' => $step,
        ];

        $this->render('front/areas/user/AddAdvert', ['data' => $data]);

    } catch (Exception $e) {
        error_log("İlan ekleme hatası: " . $e->getMessage());

        $this->render('front/areas/user/AddAdvert', [
            'error' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
        ]);
    }
}


    /**
     * POST işlemlerini yönetir
     * 
     * @param array &$data View'a gönderilecek veriler
     */
    private function handlePostRequest(&$data)
    {
        try {
            $step = isset($_POST['step']) ? (int)$_POST['step'] : 1;

            switch ($step) {
                case 1:
                    // Kategori ve alt kategori seçimini doğrula
                    if (!isset($_POST['category_id']) || empty($_POST['category_id'])) {
                        throw new Exception("Lütfen bir kategori seçin.");
                    }

                    if (!isset($_POST['subcategory_id']) || empty($_POST['subcategory_id'])) {
                        throw new Exception("Lütfen bir alt kategori seçin.");
                    }

                    // Session'a kaydet
                    $_SESSION['listing_data']['category_id'] = $_POST['category_id'];
                    $_SESSION['listing_data']['subcategory_id'] = $_POST['subcategory_id'];

                    // Marka verisini hazırla
                    $data['brands'] = $this->categoriesModel->GetBrandsBySubCategory($_POST['subcategory_id']);
                    $data['step'] = 2; // Sonraki adıma geç
                    break;

                case 2:
                    // Marka ve model seçimini doğrula
                    if (!isset($_POST['brand_id']) || empty($_POST['brand_id'])) {
                        throw new Exception("Lütfen bir marka seçin.");
                    }

                    if (!isset($_POST['model_id']) || empty($_POST['model_id'])) {
                        throw new Exception("Lütfen bir model seçin.");
                    }

                    // Session'a kaydet
                    $_SESSION['listing_data']['brand_id'] = $_POST['brand_id'];
                    $_SESSION['listing_data']['model_id'] = $_POST['model_id'];

                    $data['step'] = 3; // Sonraki adıma geç
                    break;

                case 3:
                    // İlan detaylarını doğrula
                    if (!isset($_POST['title']) || strlen($_POST['title']) < 10 || strlen($_POST['title']) > 100) {
                        throw new Exception("Başlık en az 10, en fazla 100 karakter olmalıdır.");
                    }

                    if (!isset($_POST['description']) || strlen($_POST['description']) < 20) {
                        throw new Exception("Açıklama en az 20 karakter olmalıdır.");
                    }

                    if (!isset($_POST['budget']) || floatval($_POST['budget']) <= 0) {
                        throw new Exception("Geçerli bir bütçe tutarı girilmelidir.");
                    }

                    // Session'a kaydet
                    $_SESSION['listing_data']['title'] = $_POST['title'];
                    $_SESSION['listing_data']['description'] = $_POST['description'];
                    $_SESSION['listing_data']['budget'] = floatval($_POST['budget']);

                    // İlanı kaydet
                    $this->saveAdvert($_SESSION['listing_data']);

                    // Başarılı mesajı ile dashboard'a yönlendir
                    header('Location: /areas/user/UserDashboard?success=true&message=İlanınız başarıyla yayınlandı');
                    exit;

                default:
                    throw new Exception("Geçersiz adım.");
            }
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
    }

    /**
     * İlanı veritabanına kaydeder
     * 
     * @param array $advertData İlan verileri
     * @return bool Kayıt başarılı ise true, değilse false
     */
    private function saveAdvert($advertData)
    {
        try {
            // İlan modeli oluştur
            $advertModel = $this->loadModel('Advert');

            // Kullanıcı ID'sini ekle
            $advertData['user_id'] = $this->user_id;
            $advertData['status'] = 'active';
            $advertData['created_at'] = date('Y-m-d H:i:s');

            // İlanı ekle
            $advertId = $advertModel->createAdvert($advertData);

            if (!$advertId) {
                throw new Exception("İlan eklenirken bir hata oluştu.");
            }

            // Session'dan ilan verilerini temizle
            unset($_SESSION['listing_data']);

            return true;
        } catch (Exception $e) {
            error_log("İlan kaydetme hatası: " . $e->getMessage());
            throw $e;
        }
    }
}
