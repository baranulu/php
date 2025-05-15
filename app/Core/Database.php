<?php
namespace App\Core;
ini_set('memory_limit', '256M');
use PDO;
use PDOException;

class Database
{
    private static $instance = null; // Singleton tasarım deseni ile tek bir veritabanı bağlantısı oluşturur.
    private $dbh;    //  PDO bağlantısını saklayan değişken.
    private $stmt;   //  Hazırlanan SQL sorgusunu saklayan değişken.

    public function __construct()
    {
        //  .env dosyasından veritabanı bilgilerini alır.
        $config = Config::loadEnv(); 
        $user = $config['DB_USER'];
        $pass = $config['DB_PASSWORD'];

        //  Veritabanı bağlantı dizesi (DSN) oluşturulur.
        $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset={$config['DB_CHARSET']}";

        //  PDO seçenekleri belirlenir.
        $options = [
            PDO::ATTR_PERSISTENT => true, // ⚡ Kalıcı bağlantı kullanarak her işlemde yeni bağlantı açılmasını önler.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // ⚡ Verileri dizi olarak döndürür.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ⚡ Hata modunu aktif eder (hataları yakalamak için).
            PDO::ATTR_EMULATE_PREPARES => false // ⚡ Sorguların veritabanı tarafından hazırlanmasını sağlar (daha güvenli ve hızlı).
        ];

        try {
            //  PDO bağlantısını oluşturur.
            $this->dbh = new PDO($dsn, $user, $pass, $options);
            
        } catch (PDOException $e) {
            //  Bağlantı hatası olursa mesajı gösterir ve programı durdurur.
            die("Veritabanı hatası: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        //  Singleton deseni: Eğer bağlantı daha önce oluşturulmadıysa, yeni bir bağlantı oluştur.
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance; //  Her zaman tek bir veritabanı nesnesi döndürülür.
    }

    public function query($query, $params = [])
    {   
        //  SQL sorgusunu hazırlar.
        $this->stmt = $this->dbh->prepare($query);
        
        //  Eğer parametre varsa, bunları bağlayarak sorguyu çalıştır.
        if (!empty($params)) {
            $this->stmt->execute($params);
        } else {
            $this->stmt->execute();
        }
        
        return $this->stmt; //  Çalıştırılan sorguyu döndürür.
    }

    public function bind($param, $value, $type = null)
    {
        //  Eğer parametre tipi belirtilmediyse, veri tipine göre otomatik belirler.
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT; 
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL; 
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL; 
                    break;
                default:
                    $type = PDO::PARAM_STR; 
            }
        }

        //  SQL sorgusuna parametreyi güvenli bir şekilde bağlar.
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        // SQL sorgusunu çalıştırır.
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        //  SQL sorgusunu çalıştırır ve tüm sonuçları **dizi** olarak döndürür.
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        //  SQL sorgusunu çalıştırır ve **tek bir satır** döndürür.
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        //  SQL sorgusunun döndürdüğü satır sayısını döndürür.
        return $this->stmt->rowCount();
    }
    public function getConnection()
    {
        return $this->dbh;
    }
}
?>
