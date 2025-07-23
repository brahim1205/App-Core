<?php
namespace App\core;
class Router{
  public static function resolver(){
    $route = require __DIR__.'/../../routes/route.web.php';
    $middlewares = require __DIR__.'/../config/middlewares.php';
    $uri =parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) ;
    if($route[$uri]){
        if(!empty($route[$uri]['middlewares'])){
          foreach($route[$uri]['middlewares'] as $middlewareName){
            if(array_key_exists($middlewareName,$middlewares)){
              $middlewareClass = $middlewares[$middlewareName];
              $middlewareInstance = new $middlewareClass();
              if(is_callable($middlewareInstance)){
               $middlewareInstance() ;  
              }
            }
          }
        }
     $controllerName = $route[$uri]['controller'];
     $controllerAction = $route[$uri]['action'];
     $controller = new $controllerName();
     $controller->$controllerAction();
   }
     else{
      echo '404';
     }
  }
}


