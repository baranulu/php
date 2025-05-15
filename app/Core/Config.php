<?php
namespace App\Core;

use Dotenv\Dotenv; //Ortam değişkenlerini (`.env` dosyası) yönetmek için **Dotenv** kütüphanesini kullanır.

class Config
{
 private static $config = null;

    public static function loadEnv()
    {
        //  .env dosyasını okur ve içeriğini dizi olarak döndürür.
       if(self::$config === null) {
            $dotenv = Dotenv::createImmutable(ROOT);
            $dotenv->load();
            self::$config = $_ENV;
        }
        return self::$config;
    }

    public static function get($key)
    {
        $config = self::loadEnv();
        return $config[$key] ?? null;
    }
}

?>

<!-- ### **5. `.env` Dosyasını GitHub’a Yüklememe (Önemli!)**
Bu dosya, **hassas bilgileri içerdiği için asla GitHub veya herhangi bir versiyon kontrol sistemine yüklenmemelidir**.  

Bunu önlemek için **.gitignore** dosyanızın içine `.env` ekleyin:

```sh
echo ".env" >> .gitignore
**Alternatif olarak** `.gitignore` dosyanıza manuel olarak ekleyebilirsiniz: -->