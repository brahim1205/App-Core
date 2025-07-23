<?php
namespace App\Core\Abstract;

use App\Core\App;
use App\Core\Session;
abstract class AbstractController{
  protected $layout = 'base';
  protected ?Session $session ;
  public function __construct()
  {
    $this->session = App::getDependency('Session');
  }
  abstract public function index();
  abstract public function store();
  abstract public function edit();
  abstract public function create();
  public function renderHtml(string $view,array $data=[]):void{
    extract($data);
    ob_start();
    require_once __DIR__.'/../../../template/'.$view.'.html.php';
    $content = ob_get_clean();
    require_once __DIR__.'/../../../template/layout/'.$this->layout.'.layout.php';
  }
}


