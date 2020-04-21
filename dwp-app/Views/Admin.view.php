<?php
include_once './Models/Product.model.php';

class AdminView extends ProductModel
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
            echo "<td><button>Delete</button</td> ";
            echo "<td><button>Edit</button</td> ";

            echo "</tr>";

        }

        // foreach($products as $product){
        //     echo "
        //     <div class='col'>
        //     <div class='card' style='width: 18rem;'>
        //         <img  src='./assets/images/{$product['Image']}'  class='card-img-top' alt='...''>
        //         <div class='card-body'>
        //             <h5 class='card-title'>".$product['Name']."</h5>
        //             <p class='card-subtitle mb-2 text-muted'>".$product['Price']." kr </p>
        //             <p class='card-text'>".$product['Description']."</p>
        //             <a href='#' class='btn btn-primary mB-2'>Add to basket</a>
        //             <p class='card-subtitle mb-2 text-muted'>Product Code: ".$product['Code']."</p>

        //         </div>
        //     </div>
        //     </div>" ;

        // }
        // echo "Products:".$result['Name'] .",";
    }
}

$adminView = new AdminView();


$page_title = "Admin Panel";
include_once "./assets/layout/header.php";

echo "<div class='row m-5 d-flex justify-content-center'>
<table class='table table-hover ' style='background-color:white'>
<thaed>
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
</thaed>
";
$adminView->showProducts();

echo "</table>
</div>
";
// footer
include_once "./assets/layout/footer.php";
?>

