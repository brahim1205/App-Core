<?php
namespace App\Core\Abstract;

abstract class AbstractEntity {
  abstract static public function toObject(array $data):?object;
  abstract public function toArray();
  public function toJson(){}
}