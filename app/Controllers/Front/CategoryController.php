<?php
namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Models\Response;

class CategoryController extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        // Modeli yüklüyoruz
        $this->categoryModel = $this->loadModel('Category');
    }

    public function GetActiveCategories()
    {
        $response = new Response();

        $data = $this->categoryModel-> GetActiveCategories();

        $response->value = $data->value;
        $response->result = $data->result;
        $response->exception = $data->exception;

        return $response;
    }
}

?>
