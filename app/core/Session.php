<?php 
namespace App\core;
class Session {
  private static ?Session $instance = null;
  private function __construct()
  {
    if(session_status() === PHP_SESSION_NONE){
      session_start();
    }
  }
  public static function getInstance():?Session{
    if(self::$instance === null){
      self::$instance = new Session();
    }
    return self::$instance;

  }
  public function unset(string $key){
    unset($_SESSION[$key]);
  }
  public function set(string $key,mixed $value){
    $_SESSION[$key] = $value;
  }
  public function get(string $key){
    return $_SESSION[$key];
  }
  public function isset(string $key){
    return isset($_SESSION[$key]);
  }
  public function destroy(){
    $this->instance = null;
    $_SESSION = [];
    if(session_status() === PHP_SESSION_ACTIVE){
       session_destroy();
    }
  }
}

