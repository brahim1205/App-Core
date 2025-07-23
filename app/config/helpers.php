<?php

function dd($var){
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  die('erreur ! ');

}

function redirect($url){
  header("location:$url");
  exit;
}