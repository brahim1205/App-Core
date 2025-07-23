<?php

namespace App\Core\middlewares;

use App\Core\Session;

class Auth{
  private Session $session;
  public function __construct()
  {
    $this->session = Session::getInstance();
  }
  public function __invoke(){
    $user = $this->session->isset('user');
    if(!$user){
      header('location:/');
      exit;
    }
  }
}

