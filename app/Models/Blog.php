<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use PDO;
use PDOException;

// modellerde db ye erişim yapılarak veritabanı işlemleri yapılır.
class Blog extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBlogData()
    {

        $response = new Response();

        $db = $this->db;

        try {

            $query = $db->prepare("SELECT title, created_at, description,slug FROM blog");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                $response->exception = 'Blog bilgisi bulunamadı.';
                $response->result = false;
                return $response;
                
            }

            $response->value = $result;

            $response->result = true;

        } catch (PDOException $e) {

            $response->value = [];
            $response->result = false;
            $response->exception = 'Veritabanı hatası: ' . $e->getMessage();
        }

        return $response;
    }

    public function getBlogDetailWithSlug($slug)
    {
        $response = new Response();
        $db=$this->db;

        try 
        {
            $query = $db->prepare("select * from blog where slug=:slug");
            $query->execute(['slug' => $slug]);
            $result = $query->fetch(PDO::FETCH_OBJ);

            if (empty($result)) 
            {
                $response->exception = 'Blog detay bilgisi bulunamadı.';
                $response->result = false;
                return $response;
            }

            $response->value = $result;
            $response->result = true;

        }
        catch (PDOException $e)
        {
            return $response;
        }

        return $response;
    }

}
