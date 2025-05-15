<?php

namespace App\Models;

use App\Models\Response;
use App\Models\BaseModel;
use PDOException;
use PDO;

class Category extends BaseModel
{
    
    public function __construct()
    {
       parent::__construct();
        
    }

    public function GetActiveCategories()
    {

        $response = new Response();

        $db = $this->db;

        try {
            $query = $db->prepare("SELECT * FROM category WHERE isActive = 1");

            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $parentCategories = [];
            $childCategories = [];

            foreach ($result as $category) {
                if ($category['parent_id'] == 0) {
                    $parentCategories[] = $category;
                } else {
                    $childCategories[$category['parent_id']][] = $category;
                }
            }

            foreach ($parentCategories as &$parentCategory) {
                $parentCategory['children'] = isset($childCategories[$parentCategory['id']]) ? $childCategories[$parentCategory['id']] : [];
            }

            if (empty($result)) {
           
                $response->exception = 'Kategori bulunamadı.';

                return $response;
            }

            $response->value = array_values($parentCategories); // array_values ile dizinin anahtarlarını sıfırlıyoruz

            $response->result = true;
            
        } catch (PDOException $e) {
            $response->value = [];
            $response->result = false;
            $response->exception = 'Veritabanı hatası: ' . $e->getMessage();
            return $response;
        }

        return $response;
    }

}
