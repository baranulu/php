<?php 
namespace App\Controllers\Front;

use App\Core\BaseController;

class ErrorsController extends BaseController
{
    public function NotFound()
    {
        $this->render('front/errors/404', [], 404);
    }
}

?>