<?php  

namespace App\Models;

Use App\Core\Database;
Use PDO;
use PDOException;
use App\Models\ServiceResponse;
use Exception;

class Brand extends BaseModel{


    public function __construct()
    {
        parent::__construct();
    }


    public function GetBrands($categoryId){

        $db=$this->db;
        
        try{
            
        if (!$this->categoryExists($categoryId)) {
            return ServiceResponse::error("Kategori bulunamadı", "CATEGORY_NOT_FOUND");
        }

           $query = $db->prepare("SELECT * from brands WHERE category_id =:category_id");
           $query->bindParam("category_id",$categoryId);
           $query->execute();
           
           $brands =$query->fetchAll(PDO::FETCH_ASSOC);

           if(empty($brands))
           {
            return ServiceResponse::success([], "Bu kategoride marka bulunamadı.");
           }

           $brandProductsQuery = $db->prepare("SELECT * from brand_models");
           $brandProductsQuery->execute();

           $brandProducts =$brandProductsQuery->fetchAll(PDO::FETCH_ASSOC);

           if(empty($brandProducts)){
                return ServiceResponse::success([], "Bu markaya ait ürün bulunamadı.");
           }

           $parentBrands=$brands;

        foreach($parentBrands as &$brand)
        {
            $brand['Products'] = [];

            foreach($brandProducts as $product)
            {
                if($product['brand_id']==$brand['id'])
                {
                $brand['Products'][] =$product;
                }
            }   
        }
    
        return ServiceResponse::success($parentBrands,"Marka ve Ürün bilgileri başarıyla getirildi.");
           
        }
        catch(PDOException $ex)
        {
        error_log($ex->getMessage());
        
        return ServiceResponse::error("Veritabanı hatası oluştu", "DB_ERROR");
        }
        catch(Exception $ex)
        {
        error_log("GetBrands General Error: " . $ex->getMessage());
        return ServiceResponse::error("Beklenmeyen bir hata oluştu", "GENERAL_ERROR");
        }
    }

    private function categoryExists($categoryId) {
    $query = $this->db->prepare("SELECT COUNT(*) FROM category WHERE id = :id");
    $query->bindParam(":id", $categoryId);
    $query->execute();
    return $query->fetchColumn() > 0;
}
}
?>

<!-- kendime not.

PDO dönüş tiplerini hafızaya al. -->

