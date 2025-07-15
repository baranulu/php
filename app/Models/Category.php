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

    public function getActiveCategories(): array
{
    $db = $this->db;    

    try {
        $query = $db->prepare("SELECT * FROM category WHERE isActive = 1");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return []; // Boş dizi dön, boşluk kontrolü controller'da yapılır
        }

        $parentCategories = [];
        $childCategories = [];

        foreach ($result as $category) {
            if ((int)$category['parent_id'] === 0) {
                $parentCategories[$category['id']] = $category;
            } else {
                $childCategories[$category['parent_id']][] = $category;
            }
        }

        foreach ($parentCategories as &$parentCategory) {
            $parentCategory['children'] = $childCategories[$parentCategory['id']] ?? [];
        }

        return array_values($parentCategories); // sıralı indexli dizi
    } catch (PDOException $e) {
        // Uygun Exception fırlat (veya Logger'a yaz, isteğe bağlı)
        throw new \RuntimeException("Kategori verileri alınamadı: " . $e->getMessage());
    }
}


}
