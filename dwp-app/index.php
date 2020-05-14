<?php
session_start();

if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}
$csfr_token = $_SESSION['token'];



function logged_in(){
  return isset($_SESSION['UserID']);
}

function confirm_logged_in(){
  if (!logged_in()){
      redirect_to("login");
  }
}


function redirect_to($location){
  header("Location: {$location}");
  exit;
}


require_once("reCAPTCHA.php");
require_once("routes.php");
require_once("router.php");


spl_autoload_register(function($view) {
  if(file_exists('classes/' . $view . '.view.php')){
    include 'classes/' . $view . '.view.php';
  }
 
});


?>