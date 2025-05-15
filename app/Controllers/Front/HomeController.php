<?php 
namespace App\Controllers\Front;

use App\Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {   session_start();
        
        // if (!isset($_SESSION['user_id'])) {
            
        // }
        $this->render('front/home/index');
    }
}
?>