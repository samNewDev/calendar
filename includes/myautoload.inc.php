<?php

spl_autoload_register('myAutoLoad');

function myAutoLoad($className){
  $path = 'classes/';
  $extension = ".php";
  $fullPath = $path.$className.$extension;

  if (!file_exists($fullPath)) {
    return false;
  }
  //require $fullPath;
  include_once $fullPath;
}