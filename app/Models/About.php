<?php
namespace App\Models;

use App\Models\Response;
use App\Models\BaseModel;
use PDOException;
use PDO;

class About extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

  public function getAbout()
    {
        $response = new Response();
        $db=$this->db;

        try
        {
            $query=$db->prepare("SELECT * FROM about");
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);

            if(empty($result))
            {
                $response->exception='Hakkımızda bilgisi bulunamadı.';
                $response->result=false;
                return $response;
            }

            $response->value=$result;
            $response->result=true;
            
        }
        catch(PDOException $e)
        {
            $response->value=[];
            $response->result=false;
            $response->exception='Veritabanı hatası: '.$e->getMessage();
            return $response;
        }
        
        return $response;
    }

}


?>