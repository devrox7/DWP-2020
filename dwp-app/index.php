<!-- <!DOCTYPE HTML>

<html lang="en">
<head>

  <meta charset="utf-8">

  <title>DUCK SHOP</title>
  <meta name="description" content="DUCK SHOP">

</head>


</html> -->

<?php

require_once("routes.php");
require_once("router.php");



spl_autoload_register(function($view) {
  if(file_exists('classes/' . $view . '.view.php')){
    include 'classes/' . $view . '.view.php';
  }
 
});


?>