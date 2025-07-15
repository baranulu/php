<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Core\BaseDashboardController;
use App\Models\ServiceResponse;
use Exception;

class BrandController extends BaseController
{
    private $brandModel;
    private $brandProductModel;

    public function __construct()
    {
        $this->brandModel = $this->loadModel('brand');
        $this->brandProductModel = $this->loadModel('brandProduct');
    }
}
