<?php
include_once './Controllers/Product.controller.php';


class AdminView extends ProductController
{

    public function showProducts()
    {
        $products = $this->getProducts();
        // var_dump($products);

        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>" . $product['ProductID'] . "</td> ";
            echo "<td>" . $product['Name'] . "</td>  ";
            echo "<td>" . $product['Price'] . " kr </td> ";
            echo "<td>" . $product['Code'] . "  </td> ";
            echo "<td>" . $product['Description'] . "</td> ";
            echo "<td> <img style='width:40px; height: 40px' src='./assets/images/{$product['Image']}'> </td> ";
            echo "<td><button type='button' class='btn btn-primary'><i class='fas fa-pen'></i></button</td> ";
            echo "<td><button type='button' class='btn btn-primary'><i class='fas fa-trash'></i></button</td> ";

            echo "</tr>";

        }

    }
}

$adminView = new AdminView();


$page_title = "Admin Panel";
include_once "./assets/layout/header.php";

echo "

<div class='content-container m-5'>

      <div class='row mb-4'>

        <div class='col'>
          <h4><b>Manage Products</b></h4>
        </div>

        <div class='col d-flex justify-content-end'>
          <button type='button' class='btn btn-primary'>Create Product</button>  
        </div>

      </div>
    


      <table class='table '>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Code</th>
                <th>Description</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
";

$adminView->showProducts();

echo "
</table>
</div>
";



echo "
<div class='content-container  m-5'>

      <div class='row mb-4'>

        <div class='col'>
          <h4><b>Manage Orders</b></h4>
        </div>

       

      </div>
    

    <table class='table '>
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Price</th>
              <th>Code</th>
              <th>Description</th>
              <th>Image</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
";

$adminView->showProducts();

echo "
</table>
</div>
";
// footer
include_once "./assets/layout/footer.php";
?>

