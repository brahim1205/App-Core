<?php
namespace App\Core\Abstract;

use App\Core\App;
use PDO;
abstract class AbstractRepository{
  protected PDO $pdo;
  protected string $table;
  public function __construct()
  {
    $this->pdo = App::getDependency('Database');
  }
  abstract public function SelectAll();
  abstract public function update();
  abstract public function insert();
  abstract public function selectById();
  abstract public function delete();
}

