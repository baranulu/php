<?php

namespace app\Core;

class Route
{
    private static $routes = [];
    private static $middlewares = [];

//     **`$routes`** → Uygulamada tanımlanan tüm rotaları saklar.
// - **`$middlewares`** → Rotalara atanmış olan `middleware` sınıflarını tutar.

    public static function add($uri,$controller)
    {

    self::$routes[$uri]=$controller;
    return new static;
    }

    //$lastRoute = array_key_last(self::$routes);`** → En son eklenen rotayı alır.
    //self::$middlewares[$lastRoute] = $middleware;`** → Middleware'i bu rotaya ekler.
    public static function middleware($middleware)
    {
    $lastRoute = array_key_last(self::$routes);
    self::$middlewares[$lastRoute] = $middleware;
    }

    public static function dispatch($uri)
    {
        foreach (self::$routes as $route => $controller) {
            // Dinamik parametreleri yakalamak için regex oluştur
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // İlk eleman tüm eşleşmedir, onu çıkar

                if (isset(self::$middlewares[$route])) {
                    $middleware = self::$middlewares[$route];
                    (new $middleware)->handle();
                }

                [$class, $method] = explode('@', $controller);
                $class = "App\\Controllers\\" . $class;

                if (class_exists($class) && method_exists($class, $method)) {
                    call_user_func_array([new $class, $method], $matches);
                    return;
                } else {
                    http_response_code(404);
                    echo $uri;
                    echo "404 Not Found - Sınıf ya da Metot Bulunamadı";
                    return;
                }
            }
        }

        // Eğer hiçbir rota eşleşmezse
        throw new \Exception("404 Not Found");
    }

}



?>

<!-- **Açıklama:**
**`add`** yöntemi, **yeni bir rota tanımlamak** için kullanılır.
**`self::$routes[$uri] = $controller;`** → URI ile ilişkili denetleyiciyi `$routes` dizisine ekler.
**`return new static;`** → Zincirleme metot çağrısı yapılmasını sağlar (`middleware()` metodu için gereklidir).



**`middleware`** yöntemi, **rotalara middleware eklemek** için kullanılır.
**`$lastRoute = array_key_last(self::$routes);`** → En son eklenen rotayı alır.
**`self::$middlewares[$lastRoute] = $middleware;`** → Middleware'i bu rotaya ekler.

örnek kullanım:
Route::add('/admin', 'AdminController@index')->middleware(AuthMiddleware::class);

add metodu çağrılır ve /admin URI'si ile AdminController@index denetleyicisi ilişkilendirilir.
Bu ilişkilendirme self::$routes dizisine eklenir.
return new static; ifadesi, zincirleme metot çağrısına olanak tanır ve middleware metodunun çağrılmasını sağlar.
->middleware(AuthMiddleware::class):

middleware metodu çağrılır ve en son eklenen rota (/admin) için AuthMiddleware sınıfı atanır.
Bu ilişkilendirme self::$middlewares dizisine eklenir.** -->