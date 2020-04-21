<?php

require_once("routes.php");
require_once("router.php");


spl_autoload_register(function($view) {
  if(file_exists('classes/' . $view . '.view.php')){
    include 'classes/' . $view . '.view.php';
  }
 
});


?>