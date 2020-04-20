<?php
// include './Controllers/Product.controller.php';
// include 'router.php';

?>

<!DOCTYPE HTML>

<html lang="en">
<head>

  <meta charset="utf-8">

  <title>DUCK SHOP</title>
  <meta name="description" content="DUCK SHOP">



</head>

<body>
<?php

// $product1 = new ProductView();
// $product1->showProducts();

// $product2 = new ProductController();
// $product2->createProduct("NewDuck","500", "Newest duck in the shop");
?>
<?php
require_once 'Views/Product.view.php';
require_once 'Views/Admin.view.php';

require_once "router.php";
echo "test";
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get('/', 'Views/Home.view');
$router->get('home', 'Views/Home.view');
$router->get('admin-panel', 'Views/Admin.view');
$router->get('products', 'Views/Product.view');

echo $_GET['url'];
echo $this->request;
?>

</body>
</html>