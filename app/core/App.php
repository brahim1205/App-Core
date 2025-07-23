<?php
namespace App\Core;

use Symfony\Component\Yaml\Yaml;

class App{
      private static array $instancies=[];
    
      public static function getDependency(string $nomClass){
            $dependencies = Yaml::parseFile(__DIR__.'/../config/service.yaml');
            if(array_key_exists($nomClass, self::$instancies)){
                    return self::$instancies[$nomClass];        
            }
            foreach($dependencies as $packages){
                if(isset($packages[$nomClass])){
                    $class= $packages[$nomClass];
                    if(class_exists($class)){
                            $instance=$class::getInstance();
                            if($instance){
                            self::$instancies[$nomClass]=$instance;
                            return $instance;
                            }
                       }
                   }
               }
            return null;
      }
}

