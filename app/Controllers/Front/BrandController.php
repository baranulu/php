<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Core\BaseDashboardController;

class BrandController extends BaseDashboardController
{
    private $brandModel;
    private $brandProductModel;

    public function __construct()
    {
        $this->brandModel = $this->loadModel('brand');
        $this->brandProductModel = $this->loadModel('brandProduct');
    }

    public function GetBrandAndBrandProduct()
     {
        $categoryId= $_GET['category_id']?? null;

        if (empty($categoryId) || !is_numeric($categoryId) || $categoryId <= 0) {
        return $this->jsonError("Geçersiz kategori ID", "VALIDATION_ERROR");

        
    }

     }
}
